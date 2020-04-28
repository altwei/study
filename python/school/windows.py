from common import *
from tkinter import *
from tkinter import ttk
from tkinter import messagebox
from bs4 import BeautifulSoup


class Login(ttk.Frame):
    def __init__(self, app=None):
        ttk.Frame.__init__(self, padding='50 50 50 10')
        self.app = app
        self.username = StringVar()
        self.password = StringVar()
        self.remember = StringVar()
        self.warning = StringVar()
        self.quick_login()

    def quick_login(self):
        url = 'https://wl.scutde.net/edu3/edu3/framework/index.html'
        r = session.get(url, headers=get_headers(), cookies=get_cookies())
        if re.search("window.location='https://wl.scutde.net:443/edu3/edu3/login.html'", r.text) is None:
            # 如果session有效
            soup = BeautifulSoup(r.text, 'html.parser')
            Main(self.app, soup).pack()
        else:
            # 如果session无效
            if r.cookies.__len__() > 0:
                if r.cookies.__len__() == 1:
                    r = session.get(url, headers=get_headers())

                set_cookies(r.cookies)

            self.layout()

    def layout(self):
        # 表单
        ttk.Label(self, text='用户名：').grid(column=0, row=0)
        ttk.Entry(self, width=25, textvariable=self.username).grid(column=1, row=0)
        ttk.Label(self, text='密码：').grid(column=0, row=1)
        ttk.Entry(self, width=25, textvariable=self.password, show='*').grid(column=1, row=1)
        # self.pinput.bind('<Control-x>', lambda e: 'break')
        # self.pinput.bind('<Control-c>', lambda e: 'break')
        ttk.Checkbutton(self, text='记住用户名', variable=self.remember).grid(column=1, row=2)
        ttk.Button(self, text='登录', command=self.submit).grid(column=1, row=3)
        ttk.Label(self, textvariable=self.warning, foreground='#ff0000').grid(column=1, row=4)
        # 读取配置
        for key, value in get_config().items():
            if key == 'username':
                self.username.set(value)
            if key == 'remember':
                self.remember.set(value)
        # 间距、获取焦点
        for child in self.winfo_children():
            child.grid(padx=5, pady=5, sticky=W)
            if child.winfo_class() == 'TEntry' and child.get() == '':
                child.focus()
        # 绑定回车事件
        self.app.bind('<Return>', self.submit)

    def submit(self, *args):
        # 判断用户名和密码
        for child in self.winfo_children():
            if child.winfo_class() == 'TEntry' and child.get() == '':
                self.warning.set('请输入用户名或密码')
                child.focus()
                return False
        # 记住用户名
        set_config({
            'username': ['', self.username.get()][self.remember.get() == '1'],
            'remember': self.remember.get()
        })
        # 登录操作
        data = {
            'j_username': self.username.get(),
            'j_password': self.password.get()
        }
        url = 'https://wl.scutde.net:443/edu3/j_spring_security_check'
        response = session.post(url, headers=get_headers(), cookies=get_cookies(), data=data)
        soup = BeautifulSoup(response.text, 'html.parser')
        error = soup.find('p', attrs={'class': 'title2'})
        if error is not None:
            self.warning.set(error.text)
        else:
            self.pack_forget()
            Main(self.app, soup).pack()


class Main(ttk.Frame):
    def __init__(self, app=None, soup=None):
        ttk.Frame.__init__(self, padding='10 10 10 10', height=50)
        self.app = app
        self.app['menu'] = self.menu()
        self.soup = soup
        self.table = ttk.Treeview(self, show="headings", height=30)
        self.table_content = []
        self.table_layout()

    def menu(self):
        menu = Menu(self)
        menu.add_command(label='更新随堂练习', command=self.update_exercises)
        menu.add_command(label='关于', command=self.about)
        return menu

    def update_exercises(self):
        table_item_index = []
        for index in self.table.get_children():
            table_item_index.append(index)
        # 科目初始化
        courseId = []
        planCourseId = []
        isNeedReExamination = []
        all_data = self.soup.find_all('a', onclick=re.compile('goInteractive'))
        for index, value in enumerate(all_data):
            subject_pattern = "[\s\S]+'([^']*)','([^']*)','([^']*)'[^>]+>[\s\S]+"
            a, b, c = re.match(subject_pattern, str(value)).groups()
            courseId.append(a)
            planCourseId.append(b)
            isNeedReExamination.append(c)
            # 完成情况
            url = 'https://wl.scutde.net/edu3/edu3/learning/exercise/practice-list.html'
            data = {'courseId': a}
            rs = session.post(url, headers=get_headers(), cookies=get_cookies(), data=data)
            bs = BeautifulSoup(rs.text, 'html.parser').find_all('tr')
            number, result = bs[len(bs) - 2].find_all('td'), bs[len(bs) - 1].find_all('td')
            number_total = number[2].string
            number_done = number[3].string
            number_right = number[4].string
            score = result[1].string
            self.table_content[index].extend([number_total, number_done, number_right, score])
            self.table.item(table_item_index[index], values=self.table_content[index])
            self.update()

    def about(self):
        messagebox.showinfo('关于 - by altwei', '老铁，这里没什么看的')

    def table_layout(self):
        table_head_title = []
        table_head_width = {}
        # 表头 - 获取内容和宽度
        trs = self.soup.find(id="tab").find_all('tr')
        trs.pop(0)
        for td in trs.pop(0).find_all('th'):
            table_head_title.append(td.string)
            table_head_width.update({td.string: int(re.match('[\s\S]+"([^"]+)%"[\s\S]+', str(td)).group(1)) * 12})
        table_head_title.extend(['随堂练习数目', '已经提交题目', '已答对题目', '分数'])
        table_head_width.update({'随堂练习数目': 100, '已经提交题目': 100, '已答对题目': 100, '分数': 50})
        # 表头 - 填充数据
        self.table['columns'] = table_head_title
        for title in table_head_title:
            self.table.column(title, width=table_head_width[title], anchor="center")
            self.table.heading(title, text=title)
        # 表格内容
        for tr in trs:
            item = []
            for td in tr.find_all('td'):
                item.append(re.sub('\s', '', td.get_text()))
            self.table_content.append(item)
            self.table.insert('', END, values=item)

        self.table.pack()
        # scroll
        scroll = Scrollbar(self.app, command=self.table.yview)
        scroll.pack(side=RIGHT, fill=Y)
        self.table.configure(yscrollcommand=scroll.set)
