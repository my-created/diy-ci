# diy-ci
自定义ci框架

1. 拆分前后台，公用 helper，model，library，当然 language，hooks，third_party 也是可以公用的，但是没有多大意义。
2. 重写 Loader.php(MY_Loader.php)，完成 1. 的公用功能。
3. 重写 Security(MY_Security.php)，并且添加 safe_helper.php 提供自定义 csrf 功能，config 提供了 csrf 自动以配置 csrf_off 如果为 TRUE 则关闭自定义 csrf。
4. config 添加 development 和 production 目录，下放 config.php,database.php 提供生产和开发环境支持（ci自带，我配置下）。
5. 添加 Render 库，公用渲染部分，并且提供公共的 bind（绑定值）方法，HTML 返回，json 返回，ajax 返回，auto 返回（自动根据 Content-Type: application/json 返回对应内容，还未完成，很快）。
5. composer.json 自定义添加 Blade 模板引擎和 Monolog 日志引擎，可以自行使用，日志引擎定义了 library，在 autoload.php 配置文件中添加 Monolog 库即可使用。
>Blade 被我拆出去了，有时间加进来，加入很简单。
6. 加入表单验证层，存放表单验证类。（未完成，过几天加入）