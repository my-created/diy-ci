# 项目说明

## 项目优化准则

1. model 跟随表分割。
2. 公用函数放到 helper 中。
3. library 放自定义类库。
4. 外部库都使用 composer 导入。
5. 数据库，环境，表结构等不能用代码展示的信息都要在 doc 目录中创建 markdown 文档加以说明。
6. MY_Controller 中
7. 基类还是不要放 `公用函数`，放一些`共用功能的调用`，功能还是在其他地方封装，调用在基类。比如登陆验证。
> 公共函数 = 可能用，可能不用
> 共用功能 = 每个都要用
8. 根据 header 返回 HTML，Json （重写 loader->view 方法）。
9. 所有会出错的地方都要使用 ci 默认的方法记录，除非我们重写了日志库，否则请认真阅读 ci 手册 `错误处理部分`，在编程中记录错误。

## 使用的功能模块

1. Blade 模板引擎，[laravel Blade 模板引擎文档](https://laravel-china.org/docs/laravel/5.5/blade/1304#e05dce)
2. Monolog 日志，[laravel Monolog 日志文档](https://laravel-china.org/articles/8108/the-log-system-of-laravel-monolog#e8f77f),[Monolog github](https://github.com/Seldaek/monolog)
3. ci 表单验证，[codeigniter 文档](https://codeigniter.org.cn/user_guide/libraries/form_validation.html)

## 增加配置

1. 增加了生产环境和开发环境不同的配置文件。