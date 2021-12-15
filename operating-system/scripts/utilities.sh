#!/bin/sh

# Colors
if [ -x "$(command -v tput)" ]; then
	export BOLD="$(tput bold)"
	export GREEN="$(tput setaf 2)"
	export MAGENTA="$(tput setaf 5)"
	export RED="$(tput setaf 1)"
	export YELLOW="$(tput setaf 3)"
	export WHITE="$(tput setaf 7)"
	export RESET="$(tput sgr0)"
fi

export LABEL="${RESET}${BOLD}${MAGENTA}"
export WARNING="${YELLOW}${BOLD}"
export DANGER="${RED}${BOLD}"
export SUCCESS="${GREEN}${BOLD}✔${RESET}"

# LOGO
export LILY1="${MAGENTA}${BOLD}     _      ${RESET}"
export LILY2="${MAGENTA}${BOLD}   _(_)_    ${RESET}"
export LILY3="${MAGENTA}${BOLD}  (_)${WHITE}•${MAGENTA}${BOLD}(_)   ${RESET}"
export LILY4="${green}${BOLD}   /${RESET}${MAGENTA}${BOLD}(_)     ${RESET}"
export LILY5="${green}${BOLD}   \        ${RESET}"
export LILY6="${green}${BOLD}    \       ${RESET}"

is_root_check () {
	if [ $(id -u) != 0 ]; then
		echo "${WARNING}Sorry, must be root to run this script${RESET}"
		exit 1
	fi
}

cpu_check () {
  if [ $CORES -lt 8 ]; then
    echo "${WARNING}${CORES} CPU cores, expect a long build time.${RESET}"
    sleep 1
  fi
}

print () {
  message=$1
  type=$2

  case ${type} in
    'warning')
      echo ${YELLOW}${message}${RESET}
      ;;
    'danger')
      echo ${RED}${message}${RESET}
      exit 1
      ;;
    'success')
      echo ${SUCCESS} ${message}${RESET}
      ;;
    '')
      echo "** "${GREEN}${message}${RESET}
      ;;
	esac
}
