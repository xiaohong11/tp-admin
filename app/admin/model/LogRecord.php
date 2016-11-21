<?php
namespace app\admin\model;

use \think\Config;
use \think\Model;
use \think\Session;


/**
 * 操作日志记录
 */
class logRecord extends Model
{
    protected $updateTime = false;
    protected $insert     = ['ip', 'user_id'];
    protected $type       = [
        'create_time' => 'int',
    ];

 
    protected function setIpAttr()
    {
        return \app\common\tools\Visitor::getIP();
    }

 
    protected function setUserIdAttr()
    {
        $user_id = 0;
        if (Session::has(Config::get('USER_AUTH_KEY'),'admin') !== false) {
            $user = Session::get(Config::get('USER_AUTH_KEY'),'admin');
            $user_id = $user['id'];
        }
        return $user_id;
    }
 
    public function record($remark)
    {
        $this->save(['remark' => $remark]);
    }

}
