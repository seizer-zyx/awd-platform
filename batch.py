#!/usr/bin/env python3

import time
import os
import hashlib
import sys


def copy_dir(src, dest):
    os.system('cp -r %s %s' % (src, dest))


def generate_pass(teamno):
    salt = 'yunsi_security'
    passwd = hashlib.md5(
        (salt + str(time.time()) + str(teamno)).encode('utf-8')).hexdigest()
    open('pass.txt', 'a').write('team' + str(teamno) + ':ctf:' + passwd + "\n")
    return passwd


def generate_run_sh(teamno, password):
    content = """#!/bin/sh
cd /var/www/html
service ssh start
a2enmod rewrite
service apache2 start
service mysql start
useradd ctf
echo ctf:%s | chpasswd
sleep 2

sed -i "s/ermitRootLogin without-password/ermitRootLogin yes/g" /etc/ssh/sshd_config
service sshd restart
echo root:9b453358745151482031a49ac2f95bb5 | chpasswd
# root's password = md5('root_ggbond')
sleep 1

mysql -uroot -proot < *.sql
if [ -x "extra.sh" ]; then
./extra.sh
fi
/bin/bash""" % password
    return content


def generate_docker_sh(teamno, my_port, my_image, target_id):
    content = """#!/bin/sh
docker run -p %d:%d  -p %d:22 -v `pwd`:/var/www/html -d  --name team%d -ti %s /var/www/html/run.sh
""" % (8800 + teamno + 10 * (target_id - 1), my_port, 2200 + teamno + 10 *
       (target_id - 1), teamno, my_image)
    return content


def main():
    dir = sys.argv[1]
    team_number = int(sys.argv[2])
    target_id = int(sys.argv[3])
    if len(sys.argv) == 4:
        my_image = 'se1zer/web_env'
        my_port = 80
    elif len(sys.argv) == 5:
        my_image = int(sys.argv[4])
        my_port = 80
    elif len(sys.argv) == 6:
        my_image = sys.argv[4]
        my_port = int(sys.argv[5])

    open('./pass.txt', 'w').write("")

    for i in range(team_number):

        password = generate_pass(i + 1)

        team_dir = 'team' + str(i + 1)
        copy_dir(dir, team_dir)
        print('[*] copy %s' % team_dir)

        os.system('chmod 777 -R %s' % team_dir)
        print('[*] chmod all ')

        open(team_dir + '/run.sh', 'w').write(generate_run_sh(i + 1, password))
        print('[*] write run.sh %s' % team_dir)

        open(team_dir + '/docker.sh',
             'w').write(generate_docker_sh(i + 1, my_port, my_image,
                                           target_id))
        print('[*] write docker.sh %s' % team_dir)

        os.system('chmod 700 %s/run.sh %s/docker.sh' % (team_dir, team_dir))
        print('[*] chmod run.sh & docker.sh %s' % team_dir)

        open('./pass.txt', 'a').write("%s:%s\n" % (team_dir, password))


if __name__ == '__main__':
    main()
