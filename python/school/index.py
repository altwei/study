from windows import *

app = Tk()
app.title(windows_title)

# 初始化布局
Login(app).pack()

app.mainloop()
