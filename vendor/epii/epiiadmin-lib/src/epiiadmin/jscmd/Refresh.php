<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2018/7/5
 * Time: 上午9:37
 */

namespace wslibs\epiiadmin\jscmd;


/**
 * @method \wslibs\epiiadmin\jscmd\Refresh make() static
 * @method Array data()
 * @method \wslibs\epiiadmin\jscmd\Refresh layerNum(int $num) 刷新基层，当前层代表0
 * @method \wslibs\epiiadmin\jscmd\Refresh layerStart(int $num) 刷新基层，当前层代表0
 * @method \wslibs\epiiadmin\jscmd\Refresh keyInTabsUrl(string $key)
 * @method \wslibs\epiiadmin\jscmd\Refresh type(string $type) table page both
 */

class Refresh extends JsCmdCommon
{
    public function init()
    {

        $this->layerNum(0)->keyInTabsUrl("")->type("both")->layerStart(0);

    }
}