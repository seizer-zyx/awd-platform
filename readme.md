# 前言

该项目基于https://github.com/zhl2008/awd-platform进行简化修改

为搭合CTF AWD线下赛平台[Cardinal](https://github.com/vidar-team/)使用，删除了flag_server并修改了check方式和不必要的一些功能

旨在使用python3快速搭建环境的作用

# usage

用法与原项目基本一致

```bash
python3 batch.py 环境目录 team_num target_id
example:
python3 batch.py baijiacms 4 1
```

**该处增加了target_id参数**，为了连续部署题目并保证端口不冲突

执行后将会生成team_id文件夹

**提前pull合适的镜像，并可在batch.py源码处修改镜像，这里我使用的镜像是se1zer/web_env**

或者使用以下命令来指定镜像：

```bash
python3 batch.py 环境目录 team_num target_id image_name port
example:
python3 batch.py baijiacms 4 1 web14.04 80
```

开启环境：

```bash
python3 start.py ./ team_num
example:
python3 start.py ./ 4
```

执行后将运行通过镜像生成并运行容器

**可在源码中设置check开始的时间，默认为开启4分钟后**

# 后续问题

## question1

搭配[Cardinal](https://github.com/vidar-team/)使用时，需要通过root用户ssh连接修改/flag，但该镜像不允许root用户连接

我的解决方法为修改镜像的sshd_config并赋给root密码允许连接，在batch.py的35行处加入

```bash
sed -i "s/ermitRootLogin without-password/ermitRootLogin yes/g" /etc/ssh/sshd_config
service sshd restart
echo root:9b453358745151482031a49ac2f95bb5 | chpasswd
# root's password = md5('root_ggbond')
sleep 1
```

## question2

根据Cardinal官方文档查询check接口：

```python
import requests

# Check 判断逻辑


# 发送 CheckDown 信息到平台
TOKEN = 'CHECK_MANAGER_TOKEN_HERE'  # Check Token
GameBoxID = 1   # 靶机 ID

resp = requests.post('http://localhost:19999/api/manager/checkDown', 
    json={'GameBoxID': GameBoxID}, 
    headers={'Authorization': TOKEN}).json()

if resp['error'] != 0:
    print(resp['msg'])
```

创建check账号获得token，并通过接口方法写入check.py即可

## question3

为了能够以json格式可以批量添加靶机，可以运行target.py

```bash
python3 target.py team_number(队伍总数) public_ip target_id(题目id)
example:
python3 target.py 4 127.0.0.1 1
```

以上意为生成4个队伍，第1个题目且目标ip为127.0.0.1
