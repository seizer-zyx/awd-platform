#!/usr/bin/env python3

import json
import sys

# { "ChallengeID": 1, "TeamID": 1, "IP": "", "Port": "", "SSHPort": "", "SSHUser": "", "SSHPassword": "", "Description": "" }


def generate_target_json(teamno, public_ip, target_id=1):
    ChallengeID = teamno + 10 * (target_id - 1)
    data = {
        "ChallengeID": target_id,
        "TeamID": teamno,
        "IP": public_ip,
        "Port": str(8800 + ChallengeID),
        "SSHPort": str(2200 + ChallengeID),
        "SSHUser": "root",
        "SSHPassword": "9b453358745151482031a49ac2f95bb5",
        "Description": ""
    }
    return data


def generate_hosts_list(teamno, public_ip, target_id=1):
    ChallengeID = teamno + 10 * (target_id - 1)
    host = "team%s:%s %s\n" % (teamno, public_ip, str(8800 + ChallengeID))
    return host


def main():
    team_number = int(sys.argv[1])
    public_ip = sys.argv[2]

    target_id = 1

    if len(sys.argv) == 4:
        target_id = int(sys.argv[3])

    target = []

    open('./host.lists', 'w').write("")

    for i in range(team_number):
        target.append(generate_target_json(i + 1, public_ip, target_id))
        open('./host.lists', 'a').write(generate_hosts_list(i + 1, public_ip, target_id))
    open('./target.json', 'w').write(json.dumps(target, indent=4))


if __name__ == '__main__':
    main()
