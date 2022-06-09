#!/usr/bin/env python3

import sys
import os

dir = sys.argv[1]
teamno = int(sys.argv[2])
check_time = 240


def start_generate_target():
    os.system('python3 target.py')
    print('[*] finish generate target.json')


def start_team(teamno):
    team_dir = 'team' + str(teamno)
    os.system('cd %s/%s/ && sh docker.sh' % (dir, team_dir))
    print('[*] start docker %s' % team_dir)


if __name__ == '__main__':
    for i in range(teamno):
        start_team(i + 1)
    start_generate_target()
