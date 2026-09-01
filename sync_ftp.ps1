# FTP Upload Script in PowerShell
$ftpHost = "ftp://liege.id.rapidplex.com/public_html"
$username = "eventbun"
$password = "0d95+Ws*TI4Gbx"

$localRoot = Get-Location
$ignoreDirs = @('.git', '.agents', 'node_modules', '.gemini', 'scratch')

function Ensure-FtpDirectory {
    param ([string]$remoteUri)
    try {
        $req = [System.Net.FtpWebRequest]::Create($remoteUri)
        $req.Credentials = New-Object System.Net.NetworkCredential($username, $password)
        $req.Method = [System.Net.WebRequestMethods+Ftp]::MakeDirectory
        $req.UseBinary = $true
        $req.KeepAlive = $false
        $response = $req.GetResponse()
        $response.Close()
        Write-Host "Created remote directory: $remoteUri"
    } catch {
        # Directory might already exist or parent missing
    }
}

function Upload-File {
    param (
        [string]$localPath,
        [string]$remoteUri
    )
    try {
        $webclient = New-Object System.Net.WebClient
        $webclient.Credentials = New-Object System.Net.NetworkCredential($username, $password)
        $uri = New-Object System.Uri($remoteUri)
        Write-Host "Uploading $localPath -> $remoteUri"
        $webclient.UploadFile($uri, $localPath)
        $webclient.Dispose()
    } catch {
        Write-Host "Failed uploading $localPath : $_"
    }
}

Write-Host "Starting FTP Sync via PowerShell..."

$files = Get-ChildItem -Recurse -File $localRoot | Where-Object {
    $rel = $_.FullName.Substring($localRoot.Path.Length + 1)
    $firstPart = $rel.Split('\')[0]
    $firstPart -notin $ignoreDirs -and $_.Name -ne 'sync_ftp.py' -and $_.Name -ne 'sync_ftp.ps1'
}

$createdDirs = @{}

foreach ($file in $files) {
    $relPath = $file.FullName.Substring($localRoot.Path.Length + 1).Replace('\', '/')
    $remoteUri = "$ftpHost/$relPath"
    
    # Ensure remote folder structure
    $dirParts = $relPath.Split('/')
    if ($dirParts.Length -gt 1) {
        $currentUri = $ftpHost
        for ($i = 0; $i -lt ($dirParts.Length - 1); $i++) {
            $currentUri = "$currentUri/$($dirParts[$i])"
            if (-not $createdDirs.ContainsKey($currentUri)) {
                Ensure-FtpDirectory -remoteUri $currentUri
                $createdDirs[$currentUri] = $true
            }
        }
    }

    Upload-File -localPath $file.FullName -remoteUri $remoteUri
}

Write-Host "FTP Sync Finished!"
