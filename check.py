
import time
import requests

sleep_time = 120
debug = True
headers = {
    "User-Agent":
    "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36"
}

hosts = open('./host.lists', 'r').readlines()
user_id = [host.split(':')[0] for host in hosts]
host = hosts[0].split(':')[1]
ports = [host.split(' ')[1].strip() for port in hosts]

targets = list(zip(user_id, ports))


def http(method, host, port, url, data, headers):
    req = requests

    url = f"http://{host}:{port}/{url}"

    if method == 'post' or method == 'POST':
        headers['Content-Type'] = 'application/x-www-form-urlencoded'
        res = req.post(url, data, headers=headers)
    else:
        res = req.get(url, headers=headers)
    if res.headers['set-cookie']:
        headers['Cookie'] = res.headers['set-cookie']
        pass
    if res.headers['Location']:
        print("Your 302 direct is: " + res.headers['Location'])

    return res


class check():
    def __init__(self):
        print("checking user_id: " + target[0])

    def index_check(self):
        res = http('get', host, target[1], '/web/?time=%s', '', headers)
        if '网校课程' in res:
            return True
        if debug:
            print("[fail!] index_fail")
        return False

    def test_check(self):
        res = http('get', host, target[1], '/web/teacher', '', headers)
        if 'teacher' in res:
            return True
        if debug:
            print("[fail!] test_fail")
        return False

    def login_check(self):
        headers['Cookie'] = 'PHPSESSID=ujg0tpds1u9d23b969f2duj5c7;'
        headers['X-Requested-With'] = 'XMLHttpRequest'
        res = http('post', host, target[1], '/admin/login/index.html',
                   'username=admin&password=admin&verify=7480', headers)
        if '"status":1' in res:
            return True
        if debug:
            print("[fail!] login_fail")
            return False

    def admin_check(self):
        data = 'eval(666)'
        headers['Cookie'] = 'PHPSESSID=ujg0tpds1u9d23b969f2duj5c7;'
        res = http('get', host, target[1], '/admin/tools/database?type=export',
                   data, headers)
        http('get', host, target[1], '/admin/login/loginout.html', '', headers)
        if 'qq3479015851_article_type' in res:
            return True
        if debug:
            print("[fail!] admin_fail")
        return False


def server_check():
    try:
        a = check()
        if not a.index_check():
            return False
        if not a.test_check():
            return False
        if not a.test_check_2():
            return False
        return True
    except Exception as e:
        print(e)
        return False


# print(targets)
game_round = 0
while True:

    print(
        "--------------------------- round %d -------------------------------"
        % game_round)
    for target in targets:
        print(
            "---------------------------------------------------------------")
        if server_check():
            print("team%s: %s:%s seems ok" % (target[0], host, target[1]))
            # scores.append("1")
        else:
            print("team%s: %s:%s seems down" % (target[0], host, target[1]))
            # scores.append("-1")
    game_round += 1
    time.sleep(sleep_time)
