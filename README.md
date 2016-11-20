> 喜欢就Star，不只是Fork；

> 想要分享的动机才是驱动力，而技术仅仅是一种方法。

======================

# 万能后台——自定义扩展功能
**[基于TP5](http://thinkphp.cn/),在此感谢**


- 要封装常用功能 [main.js源代码](https://github.com/Aierui/web/blob/master/public/js/admin/main.js)、如初始化selector、空对象判断、重定向、modal、全局的ajax请求、js中加载js/css文件、数据验证、重写了alert弹出层、增加 弹出确认提示框。
- Gridview.js [源代码](https://github.com/Aierui/web/blob/master/public/js/admin/gridview.js)————另一个独特地方--再次简化了bootstrap-table.js 让表格显示、数据提交变得更加简洁、组件化去功能开发。
-  在common模块写了 AdminBase、Permission两个重要的基础类


# 体验
- [地址](http://web.shijinrong.cn/admin/) http://web.shijinrong.cn/admin/login
- 账号：13330613321 （这不是我的手机号，也请不要骚扰别人）
- 密码：123


# 功能

### 账号管理
**添加、编辑、删除、搜索等** 这里节点都可以在菜单管理中进行添加修改等


### 菜单管理
**添加、编辑、删除等**，对每一个菜单同时能够对其节点增删改操作


### 角色管理
**所有菜单功能（含节点）均可自定义授权**


# 开发
###以用户留言为例

#### 后台逻辑代码
```
	/**
	 * 添加
	 */
	public function add()
	{
		if (request()->isPost()) {
			$data = request()->param();
			$data['create_time'] = time();
			$res = $this->comment->insert($data);
			if ($res == 1) {
				return info("添加成功!",1);
			}else{
				return info("添加失败!",0);
			}
		}		
		return $this->fetch('edit');
	}


	/**
	 * 编辑
	 */
	public function edit($id = 0)
	{
		if(intval($id) < 0){
			return info("数据ID异常",0);
			exit;
		}
		if (request()->isPost()) {
			$data = request()->param();
			$res = $this->comment->update($data);
			if ($res == 1) {
				return info("编辑成功!",1);
			}else{
				return info("编辑失败!",0);
			}
		}		
		$data = $this->comment->where('id',$id)->find();
		$this->assign('data',$data);
		return $this->fetch();
	}

```

#### 模板页面

```
{__NOLAYOUT__}
<form data-method="post" data-action="/{$Request.module}/{$Request.controller}/{$Request.action}" data-submit="ajax" data-validate="true" class="form-horizontal">
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">{$data['id']?'修改':'添加'}留言</h3>
                </div>
                <input type="hidden" name="id" value="{$data.id ?? ''}">
                <div class="modal-body">
                    <div class="modal-body-content">
                        <div class="form-group must">
                            <label class="col-sm-3 control-label">称呼</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="name" maxlength="8" placeholder="至多8个字符" required value="{$data.name ?? ''}">
                            </div>
                        </div>
                        <div class="form-group must">
                            <label class="col-sm-3 control-label">内容</label>
                            <div class="col-sm-7">
                                <textarea class="form-control required" name="content" maxlength="150" rows="3">{$data['content'] ?? ''}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </div>
        </div>
    </div>
</form>
```

> 小伙伴们，有没有觉得很简洁、优美呢？没有任何脚本

> 是因为我在系统都做了基础封装，想了解更多，欢迎骚扰。


# 交流
- 大家可以在github上Issues
- 在[这个后台](http://web.shijinrong.cn/admin/)我增加了一个用户建议、也可以留言
- 欢迎提出bug、便于我接下来修改
- 若你还有足够的精力和时间，欢迎你也加入进来
- **暂时不对外提供数据库、需要请微信（imland）我**




=======================

- doing... 
- fighting...

### Schedule track

- update admin login/auth 16.9.27
- update admin menu/auth 16.10.17
- update admin node/users 16.10.21
- update admin toolbar/bootstrap-table  16.10.22
- update admin main.js/gridview.js  16.10.23
- 改动main.js /gridview.js /add 16.10.24/25
- …………调试调试修改
- 预习考试去了  10.26-10.30
- 继续完善mmain.js / gridview.js   - 11.4 
- 今天码代码4小时 效果不错，但是昨日遗留问题没有解决 16.11.10
- 今晚凑单的可以一起呀！！！！！！！！！！！！！！！！！
- 完成角色授权 2016.11.12
- 完成菜单等所有的bug 2016.11.13/14
