#!/bin/sh

# ------------------------------------
# This is a script to manage multiple
# Docker containers in a "elegant" way
# ------------------------------------

# shellcheck disable=SC1017
# shellcheck disable=SC2155

BASE_DIR="$(pwd)"
LIST='./containers'

RED="$(tput setaf 1)"
GREEN="$(tput setaf 2)"
RESET="$(tput sgr0)"

do_action () {
  FOLDER=$1
  ACTION=$2

  cd "$BASE_DIR" || exit
  cd "$FOLDER" || exit

  if [ "$ACTION" = "start" ]; then
    echo "Starting docker-compose in ${GREEN}${FOLDER}${RESET}"
    docker-compose up -d --no-recreate --no-build --no-deps
  fi

  if [ "$ACTION" = "stop" ]; then
    echo "Stopping docker-compose in ${GREEN}${FOLDER}${RESET}"
    docker-compose stop
  fi

  if [ "$ACTION" = "stop" ]; then
    echo "Status in ${GREEN}${FOLDER}${RESET}"
    docker-compose status
  fi
}

loop () {
	ACTION=$1

  if [ ! -z "$ACTION" ] && [ -e "$LIST" ]; then
    cat "$LIST" | while read -r FOLDER; do
      do_action "$FOLDER" "$ACTION"
    done

    exit 0
  else
    echo "${RED}Sorry, something went wrong${RESET}"
  fi
}

start () {
  loop "start"
}

stop () {
  loop "stop"
}

restart () {
  stop
  start
}

status () {
  loop "status"
}

help () {
  cat <<EOF
${GREEN}start${RESET}       Start all containers
${GREEN}stop${RESET}        Stop all containers
${GREEN}restart${RESET}     Restart all containers
${GREEN}status${RESET}      See status on all containers
EOF
}

case "$1" in
  "start") start ;;
  "stop") stop ;;
  "restart") restart ;;
  "status") status ;;
  "") help ;;
esac
