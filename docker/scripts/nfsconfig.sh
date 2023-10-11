#!/usr/bin/env bash
export PATH=$PATH:/usr/local/bin/:/usr/bin

set -ue
set -o pipefail
shopt -s expand_aliases

declare OS="$(uname -s)"
declare green="\033[0;32m"
declare neutral="\033[0m"
declare red="\e[31m"
declare yellow="\e[33m"
declare exportsPath="/etc/exports"
declare projectPath="${1}"
declare nfsConfPath="/etc/nfs.conf"
declare nfsConf="nfs.server.mount.require_resv_port = 0"
declare divider="====================================\n"

function welcome()
{
    printf ${yellow}
    printf ${divider}
    printf "MacOS NFS setup for guest machines\n"
    printf ${divider}
    printf ${neutral}
    printf "\n"
}

function validate()
{
    if [ ! -d "${projectPath}" ]; then
        printf ${red}
        printf "Project path does not exist.\n"
        printf ${neutral}
        exit 1
    fi
}

function checkOS()
{
    printf ${green}
    printf "Checking OS...\n"
    printf ${neutral}

    if [ "${OS}" != "Darwin" ]; then
        printf ${red}
        printf "This script is for OSX-only. Please do not run it on other operating systems.\n"
        printf ${neutral}
        exit 1
    fi
    printf "Your OS is supported.\n\n"
}

function checkExports()
{
    printf ${green}
    printf "Checking NFS exports file...\n"
    printf ${neutral}
    printf "NFS exports file: "
    printf ${exportsPath}
    printf "\n"

    if sudo grep -q "${projectPath}" ${exportsPath}; then
        printf ${neutral}
        printf "Your NFS exports file is correct.\n\n"
    else
        printf ${neutral}
        printf "Updating NFS exports file...\n"
        updateExports
        printf "Restarting NFS...\n"
        sudo nfsd restart
        printf "NFS exports file update complete.\n"
    fi
}

function checkConfig()
{
    printf ${green}
    printf "Checking NFS config...\n"
    printf ${neutral}
    printf "NFS config file: "
    printf ${nfsConfPath}
    printf "\n"

    if sudo grep -q "${nfsConf}" ${nfsConfPath}; then
        printf ${neutral}
        printf "Your NFS config is correct.\n\n"
    else
        printf ${neutral}
        printf "Updating NFS config...\n\n"
        updateConf
        printf "Restarting NFS...\n"
          sudo nfsd restart
        printf "NFS config update complete.\n"
    fi
}

function updateExports()
{
    sudo tee -a ${exportsPath} > /dev/null <<EOT
# DOCKER-CONFIG-BEGIN ${projectPath}
"${projectPath}" -alldirs -mapall=501:20 localhost
# DOCKER-CONFIG-BEGIN ${projectPath}
EOT
}

function updateConf()
{
    sudo tee -a ${nfsConfPath} > /dev/null <<EOT
${nfsConf}
EOT
}

function success()
{
    printf ${green}
    printf ${divider}
    printf "NFS config tool ran successfully\n"
    printf ${divider}
    printf ${neutral}
    exit 0
}

welcome
checkOS
validate
checkExports
checkConfig
success