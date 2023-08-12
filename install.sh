RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
MAGENTA='\033[0;35m'
CYAN='\033[0;36m'
GRAY='\033[0;37m'
NC='\033[0m' # No Color
myIP="$(dig +short myip.opendns.com @resolver1.opendns.com)"

            echo -e "${RED}Note:${NC}${GREEN} Enter each parameter carefully:${NC}"
            echo -e ""
            
            read -e -p "      1. Please Enter the Destination IP Address: " -i "192.168.10.1" desIP
            desIP=${desIP:-"192.168.10.1"}

            read -e -p "      2. Please Enter the Destination SSH Port: " -i "22" desSP
            desSP=${desSP:-"22"}

            read -e -p "      3. Please Enter the Destination Target Port: " -i "22" desEP
            desEP=${desEP:-"22"}

            read -e -p "      4. Please Enter the Source Target Port: " -i "10022" srcSP
            srcSP=${srcSP:-"1022"}

            cd /usr/local/bin

            echo "#!/bin/sh
sudo iptables -t nat -A POSTROUTING -j MASQUERADE
sudo ssh -p ${desSP:-"22"} -f -N -L 0.0.0.0:${srcSP:-"1022"}:${desIP:-"192.168.10.1"}:${desEP:-"22"} root@${desIP:-"192.168.10.1"}" >> tunnel.sh

            sudo ssh -p ${desSP:-"22"} -f -N -L 0.0.0.0:${srcSP:-"1022"}:${desIP:-"192.168.10.1"}:${desEP:-"22"} root@${desIP:-"192.168.10.1"}

            cd

            clear

            echo -e "${GREEN}SSH Tunnle Successfully Configured.${NC}"
            echo ""
            echo -e "All incoming traffic from port: ${YELLOW}${srcSP:-"1022"}${NC} on this server, will be forwarded to ${YELLOW}${desIP:-"192.168.10.1"}:${desEP:-"22"}${NC}"
            echo ""
