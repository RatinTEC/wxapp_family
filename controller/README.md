# api接口
项目当中进行重要的数据处理的接口
## 文件与目录结构
index.php 为重要的入口文件<br>
config.php为整个程序的配置文件: 用来存放一些配置参数例如数据库连接地址,数据库操作对象等等...<br>
每增加一个功能就在当前目录下面创建相应的php文件<br>
前端当中调用的时候要通过 www.domain.com/index.php?method={$file} 来进行调用<br>
## 接口菜单
* 访问记录接口 
接口地址  	:  	index.php?method=visit<br>
method		:	get<br>
* 用户登录接口
接口地址	:	index.php?method=user.login<br>
method		:	get<br>
