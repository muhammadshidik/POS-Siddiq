<?php
function group1()
{
    return ['3'];
}
function group2()
{
    return ['6'];
}
function group3()
{
    // 4 : PIC , 5 : Administrator
    return ['4', '5'];
}
function role_available()
{
    //3 : instructor, 6: student
    return ['3', '6'];
}

//in_array

function canAddModul($role)
{
    if (in_array($role, group1())) {
        return true;
    }
}
