<?php

namespace App\Entity\Base;


trait BaseVirtual
{
    /**
     * @param $value
     * @return mixed
     */
    public function checkValueExist($value)
    {
        $function = "";
        foreach (debug_backtrace() as $item){
            if (isset($item["class"]) && get_class($this) == $item["class"] && $item["function"] != __FUNCTION__){
                $function = $item["function"];
                break;
            }
        }

        if ($value){
            return $value;
        }elseif ($this->entityLang && $this->entityLang->containsKey(0)) {
            return $this->entityLang->get(0)->$function();
        }

        return $value;
    }
}