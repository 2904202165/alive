# 活着么 (Alive.SYS) 🟢

一个极简的、带有温度的独居平安报备系统。
> "别问死了么，我只想知道你安好。"

![Project Status](https://img.shields.io/badge/Status-Active-success)
![License](https://img.shields.io/badge/License-MIT-blue)
![PHP](https://img.shields.io/badge/PHP-8.0+-purple)

## 📖 项目简介

**Alive.SYS** 是一款专为独居老人、独居青年设计的「平安报备」工具。
与市面上冰冷的“死人开关”不同，我们主打**极简操作**与**情感连接**。

用户每天只需点击一次页面上的大圆圈，即可报平安。
系统接入了 AI 大模型，每次签到都会收到一句温暖的、不重样的问候。
如果用户超过设定时间（如24小时）未签到，系统将自动触发邮件，通知预设的紧急联系人。

## ✨ 核心功能

* **极简交互**：专为老人设计，超大字体，无需注册，无需下载 App。
* **AI 温暖提醒**：接入 DeepSeek/硅基流动 API，根据天气和时间生成暖心问候。
* **隐形防御**：内置蜜罐 (Honeypot) 与 IP 限流，防止恶意注册骚扰。
* **三级熔断机制**：
    * 超时 24h -> 发送第 1 封邮件。
    * 超时 48h -> 发送第 2 封邮件。
    * 超时 72h -> 发送最后通牒，标记为失联，停止发送（防止长期骚扰）。
* **可视化后台**：基于 ECharts 的数据看板，直观管理用户状态。

## 🛠️ 技术栈

* **前端**：HTML5, Tailwind CSS, JavaScript (Fetch API)
* **后端**：PHP 8.0+ (原生无框架，轻量高效)
* **数据库**：MySQL 5.7+
* **依赖**：无需 Composer，开箱即用

## 🚀 快速部署

### 1. 环境要求
* PHP >= 8.0
* MySQL >= 5.6
* Nginx / Apache
* 支持 SMTP 的邮箱（如 QQ 邮箱）

### 2. 安装步骤
1. 下载本项目代码，上传至网站根目录。
2. 在数据库中导入 `database.sql` 文件。
3. 修改 `conn.php`，填入你的数据库账号密码。
4. 访问 `http://你的域名/login.php`，默认管理员账号请在数据库手动插入或使用注册功能生成。

### 3. 配置定时任务 (监控核心)
为了实现自动发邮件功能，请在服务器（如宝塔面板）添加计划任务：

* **任务类型**：访问 URL
* **执行周期**：每 30 分钟 或 1 小时
* **URL 地址**：`http://你的域名/monitor.php?key=YOUR_SECRET_KEY`
* *(请务必在 monitor.php 中修改 $CRON_KEY 为你自己的密钥)*

### 4. 接入 AI (可选)
打开 `api.php`，找到 `$SILICON_KEY`，填入你的硅基流动 (SiliconFlow) API Key。如果不填，系统将使用默认的本地问候语。

## 📄 版权说明
本项目由 **Slice** 开发，采用 MIT 开源协议。
欢迎 Star ⭐ 和 Fork！

**开发者联系方式：**

![WeChat](https://source.ictcode.com/wechat.jpg)
