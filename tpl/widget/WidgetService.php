<?php
namespace App\Services;
class WidgetService
{

    /**
     * [web 返回网站根目录]
     * @author limx
     */
    public function sex($id = '男')
    {
        $sex = ['男', '女'];
        $contest = '';
        foreach ($sex as $v) {
            $contest .= "<option value='{$v}'";
            if ($id == $v)
                $contest .= " checked='checked' ";
            $contest .= " >{$v}</option>";

        }
        echo $contest;
    }
}