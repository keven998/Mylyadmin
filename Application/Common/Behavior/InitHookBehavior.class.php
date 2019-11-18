<?php
// +----------------------------------------------------------------------
// | 零云 [ 简单 高效 卓越 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lingyun.net All rights reserved.
// +----------------------------------------------------------------------
// | Author: jry <598821125@qq.com>
// +----------------------------------------------------------------------
namespace Common\Behavior;

use Think\Behavior;
use Think\Hook;

defined('THINK_PATH') or exit();

/**
 * 初始化钩子信息
 * @author jry <598821125@qq.com>
 */
class InitHookBehavior extends Behavior
{
    /**
     * 行为扩展的执行入口必须是run
     * @author jry <598821125@qq.com>
     */
    public function run(&$content)
    {
        // 安装模式下直接返回
        if (defined('BIND_MODULE') && BIND_MODULE === 'Install') {
            return;
        }

        // 添加插件配置
        $addon_config['ADDON_PATH']                         = './Addons/';
        $addon_config['AUTOLOAD_NAMESPACE']                 = C('AUTOLOAD_NAMESPACE');
        $addon_config['AUTOLOAD_NAMESPACE']['Addons']       = $addon_config['ADDON_PATH'];
        $addon_config['TMPL_PARSE_STRING']                  = C('TMPL_PARSE_STRING');
        $addon_config['TMPL_PARSE_STRING']['__ADDON_DIR__'] = C('TOP_HOME_PAGE') . '/Addons';
        C($addon_config);

        $data = S('hooks');
        if (!$data || APP_DEBUG === true) {
            $hooks = D('Admin/Hook')->getField('name,addons');
            foreach ($hooks as $hook => $value) {
                if ($value) {
                    $map['status'] = 1;
                    $names         = explode(',', $value);
                    $map['name']   = array('IN', $names);
                    $data          = D('Admin/Addon')->where($map)->getField('id,name');
                    if ($data) {
                        // 过滤掉插件目录不存在的插件
                        foreach ($data as $key => $val) {
                            if (!is_dir('./Addons/' . $val)) {
                                unset($data[$key]);
                            }
                        }
                        $addons = array_intersect($names, $data);
                        Hook::add($hook, array_map('get_addon_class', $addons));
                    }
                }
            }
            S('hooks', Hook::get());
        } else {
            Hook::import($data, false);
        }
    }
}
