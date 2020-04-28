import requests

# 初始化session
session = requests.session()
# title
windows_title = '华工作业帮v0.1 - by altwei'
# 配置文件
config_file = 'config.json'


# 获取头信息
def get_headers():
    return {
        'Accept': '*/*',
        'Accept-Encoding': 'gzip, deflate',
        'Accept-Language': 'zh-CN,zh;q=0.9',
        'User-Agent': 'Mozilla/5.0(Macintosh;U;IntelMacOSX10_6_8;en-us)AppleWebKit/534.50(KHTML,likeGecko)Version/5.1Safari/534.50',
        'Referer': 'http://wl.scutde.net/edu3/edu3/framework/index.html'
    }


# 获取配置
def get_config():
    with open(config_file, 'a+') as f:
        f.seek(0)
        r = f.read()
        if r == '':
            return {}
        else:
            return eval(r)


# 修改配置
def set_config(data):
    configs = get_config()
    configs.update(data)
    with open(config_file, 'w') as f:
        f.write(str(configs))


# 获取cookie
def get_cookies():
    cookies = {}
    for key, value in get_config().items():
        if key == 'cookies' and value != '':
            for item in value.strip(';').split(';'):
                k, v = item.split('=')
                cookies[k] = v
            break
    return cookies


# 写入cookie
def set_cookies(cookies_dict):
    cookies = ''
    for c in cookies_dict:
        cookies += c.name + '=' + c.value + ';'
    set_config({'cookies': cookies})
