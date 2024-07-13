@echo off
cd /d %~dp0
echo ------------------------
echo Do you want this Repo
echo with version code 2.21_1.10.100?
echo ------------------------
pause
git add .
git commit -m "2.21_1.10.100"
git push -u origin main
pause