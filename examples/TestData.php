<?php
class TestData
{
    private static $instance = null;

    /**
     * @return static|null
     */
    public static function instance()
    {
        if (self::$instance == null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    private function __construct()
    {
    }

    public function unixTimestampStr()
    {
        $arr = explode(' ', microtime());
        $suffix = substr(explode('.', $arr[0])[1], 0, 6);
        return $arr[1] . $suffix;
    }

    public function randomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    /**
     * @return string|null
     * 模拟手机号
     */
    private function getTel()
    {
        return rand(0, 10) > 3 ? $this->unixTimestampStr() : "";
    }


    private function getDays($num)
    {
        $days = [
            '2020-01-01', '2020-01-02', '2020-01-03', '2020-01-04',
            '2020-01-05', '2020-01-06', '2020-01-07', '2020-01-08',
            '2020-01-09', '2020-01-10', '2020-02-01', '2020-02-02',
            '2020-02-03', '2020-02-04', '2020-02-05', '2020-02-06',
            '2020-02-07', '2020-02-08', '2020-02-09', '2020-02-10',
        ];
        $c = count($days);
        $arr = [];
        for ($i = 0; $i < $num; $i++) {
            $arr[] = $days[rand(0, $c - 1)];
        }
        return array_values(array_unique($arr));
    }

    private function getRandDate(){
        $date = new \DateTime();
        $day = rand(1,30);
        $interval = new \DateInterval('P'.$day.'D');
        return $date->add($interval)->format("Y-m-d H:i:s");
    }

    private function getTitle(){
        $title = ["城固","成都","北京","上海","安其拉","mac","苹果","华为","我是你大爷","我不打野","吃客打野","来打野",
                "刺客","刺客打野","我玩你打野个蛋","哈","我不吃蝙蝠","好好活着","真香"];
        $arr = [];
        $c= count($title);
        $num = rand(5,9);
        for ($i=0; $i<$num;$i++){
            $arr[] = $title[rand(0,$c-1)];
        }
        return implode('',$arr);
    }

    public function getData()
    {
        $data = [
            'username' => $this->unixTimestampStr(), //姓名唯一
            'pwd' => md5($this->randomString(4)),
            'gender' => rand(0, 2),
            'content' => $this->randomString(rand(100, 500)),
            'time' => time(), //时间戳格式
            'date' => $this->getRandDate(), //时间格式
            'type' => rand(0, 10),
            'days' => $this->getDays(rand(2, 8)), //储存数组
            'title' => $this->getTitle(),//用户模糊匹配
            //'tel' => $this->getTel(),//手机号，唯一，允许为空
        ];
        $tel = $this->getTel();
        if($tel){
            $data['tel'] = $tel;
        }
        return $data;
    }


}