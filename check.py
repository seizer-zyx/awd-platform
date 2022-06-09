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
host = hosts[0].split(':')[1].split(' ')[0]
ports = [port.split(' ')[1].strip() for port in hosts]

targets = list(zip(user_id, ports))


def http(method, host, port, url, data, headers):
    req = requests

    url = f"http://{host}:{port}/{url[1:] if url[0] == '/' else url}"
    print(url)

    if method == 'post' or method == 'POST':
        headers['Content-Type'] = 'application/x-www-form-urlencoded'
        res = req.post(url, data, headers=headers, allow_redirects=False)
    else:
        res = req.get(url, headers=headers)
    if 'set-cookie' in res.headers:
        # headers['Cookie'] = res.headers['set-cookie']
        pass
    if 'Location' in res.headers:
        print("Your 302 direct is: " + res.headers['Location'])
    return res


class check():
    def __init__(self):
        print("checking user_id: " + target[0])

    def index_check(self):
        res = http('get', host, target[1],
                   '/index.php?mod=mobile&act=public&do=index&beid=1', '',
                   headers).text
        if '登录' in res:
            return True
        if debug:
            print("[fail!] index_fail")
            return False

    def test_check(self):
        res = http('get', host, target[1], '/admin.php', '', headers).text
        if '登录' in res:
            return True
        if debug:
            print("[fail!] test_fail")
            return False

    def login_check(self):
        headers['Cookie'] = 'PHPSESSID=ujg0tpds1u9d23b969f2duj5c7;'
        res = http('post', host, target[1],
                   '/index.php?mod=mobile&act=public&do=login&beid=1',
                   'username=admin&password=admin666&submit=1', headers)

        if res.status_code == 302:
            return True
        if debug:
            print("[fail!] login_fail")
            return False

    def admin_check(self):
        headers['Cookie'] = 'PHPSESSID=ujg0tpds1u9d23b969f2duj5c7;'
        res = http('get', host, target[1],
                   '/index.php?mod=site&act=manager&do=database&beid=1', '',
                   headers).text
        if '备份' in res:
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
        if not a.login_check():
            return False
        if not a.admin_check():
            return False
        return True
    except Exception as e:
        print(e)
        return False


def check_down(ID):
    TOKEN = 'CHECK_MANAGER_TOKEN_HERE'  # Check Token
    GameBoxID = ID  # 靶机 ID

    resp = requests.post('http://localhost:19999/api/manager/checkDown',
                         json={
                             'GameBoxID': GameBoxID
                         },
                         headers={
                             'Authorization': TOKEN
                         }).json()

    if resp['error'] != 0:
        print(resp['msg'])


# print(targets)
# print(host)
team_num = len(targets)
# print(team_num)
game_round = 1
while True:

    print(
        "--------------------------- round %d -------------------------------"
        % game_round)
    for target in targets:
        target_num = (int(target[1])-8800) + 1
        ID = target_num * team_num + (int(target[1]) - 8800) % 10
        print(
            "---------------------------------------------------------------")
        if server_check():
            print("team%s: %s:%s seems ok" % (target[0], host, target[1]))
            # check_down(ID)
        else:
            print("team%s: %s:%s seems down" % (target[0], host, target[1]))
            check_down(ID)
    game_round += 1
    time.sleep(sleep_time)
