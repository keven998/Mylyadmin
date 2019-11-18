<?php
// +----------------------------------------------------------------------
// | 零云 [ 简单 高效 卓越 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lingyun.net All rights reserved.
// +----------------------------------------------------------------------
// | Author: jry <598821125@qq.com>
// +----------------------------------------------------------------------
namespace Admin\Controller;

/**
 * 后台默认控制器
 * @author jry <598821125@qq.com>
 */
class IndexController extends AdminController
{
    /**
     * 默认方法
     * @author jry <598821125@qq.com>
     */
    public function index()
    {
        $index_count['module'] = D('Admin/Module')->count();
        $index_count['addon']  = D('Admin/Addon')->count();
        $index_count['users']  = D('Admin/User')->count();

        // 查询今天注册用户
        $start_date         = strtotime(date('Y-m-d', time())); //今天
        $end_date           = $start_date + 86400;
        $map['create_time'] = array(
            array('egt', $start_date),
            array('lt', $end_date),
        );
        $index_count['today'] = D('Admin/User')->where($map)->count();

        // 查询实时在线用户
        $con                   = array();
        $con['update_time']    = array('gt', time() - 180);
        $con['uid']            = array('gt', 0);
        $index_count['online'] = M('admin_session')->where($con)->count();

        // 模板赋值
        $this->assign('index_count', $index_count);
        $this->assign('meta_title', "首页");
        $this->display();
    }

    /**
     * 删除缓存
     * @author jry <598821125@qq.com>
     */
    public function removeRuntime()
    {
        $file   = new \lyf\File();
        $result = $file->del_dir(RUNTIME_PATH);
        if ($result) {
            $this->success("缓存清理成功");
        } else {
            $this->error("缓存清理失败");
        }
    }
}
