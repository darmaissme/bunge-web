import os
import sys
import ftplib

FTP_HOST = "liege.id.rapidplex.com"
FTP_USER = "eventbun"
FTP_PASS = "0d95+Ws*TI4Gbx"
REMOTE_ROOT = "/public_html"
LOCAL_ROOT = os.path.dirname(os.path.abspath(__file__))

IGNORE_DIRS = {'.git', '.agents', 'node_modules', '.gemini', 'scratch'}

def ensure_remote_dir(ftp, remote_dir):
    parts = [p for p in remote_dir.split('/') if p]
    path = ''
    for part in parts:
        path += '/' + part
        try:
            ftp.cwd(path)
        except ftplib.error_perm:
            try:
                ftp.mkd(path)
                print(f"Created remote dir: {path}")
            except Exception as e:
                print(f"Failed creating dir {path}: {e}")

def sync_folder(local_folder, remote_folder):
    try:
        ftp = ftplib.FTP(FTP_HOST)
        ftp.login(FTP_USER, FTP_PASS)
        print(f"Connected to {FTP_HOST}")
    except Exception as e:
        print(f"FTP connection failed: {e}")
        return

    ensure_remote_dir(ftp, remote_folder)

    for root, dirs, files in os.walk(local_folder):
        # Filter ignored dirs
        dirs[:] = [d for d in dirs if d not in IGNORE_DIRS]

        rel_path = os.path.relpath(root, local_folder)
        if rel_path == '.':
            target_remote = remote_folder
        else:
            target_remote = remote_folder + '/' + rel_path.replace('\\', '/')

        ensure_remote_dir(ftp, target_remote)

        for file in files:
            local_file_path = os.path.join(root, file)
            remote_file_path = target_remote + '/' + file
            
            try:
                ftp.cwd(target_remote)
                with open(local_file_path, 'rb') as f:
                    print(f"Uploading {os.path.relpath(local_file_path, LOCAL_ROOT)} -> {remote_file_path}")
                    ftp.storbinary(f'STOR {file}', f)
            except Exception as e:
                print(f"Error uploading {local_file_path}: {e}")

    ftp.quit()
    print("FTP Sync completed successfully!")

if __name__ == '__main__':
    print("Starting FTP Sync...")
    sync_folder(LOCAL_ROOT, REMOTE_ROOT)
