<?php
    //battle
    define('BATTLE_STATUS_UNCONFIRM', 0); 
    define('BATTLE_STATUS_CONFIRM', 1); 
    define('BATTLE_MATCHTICK', 3);
    define('BATTLE_WAITTICK', 2); 
    define('BATTLE_WAITMAX', 5); 
    define('BATTLE_MATCH_RATE', 0.9); 
    define('BATTLE_MATCH_TIME', 50); 
    define('BATTLE_ROUNDMAX', 3);
    define('BATTLE_ROUNDMIN', 1);
    define('BATTLE_LOSE', -1);
    define('BATTLE_DRAW', 0);
    define('BATTLE_WIN', 1);
    define('BATTLE_QUIT', -1);
    define('BATTLE_NORMAL', 0);
    define('BATTLE_REPLAY', 1);
    define('BATTLE_HP', 300);
    define('BATTLE_ROUNDTIME', 50);

    define('BATTLE_BALL_RECOVERY_HP', 10);
    define('BATTLE_BALL_RECOVERY_LOWRATE', 50);
    define('BATTLE_BALL_RECOVERY_HIGHRATE', 200);
    define('BATTLE_BALL_STONE_LOWRATE', 0);
    define('BATTLE_BALL_STONE_HIGHRATE', 1000);
    define('BATTLE_BALL_EXPLODE_LOWRATE', 500);
    define('BATTLE_BALL_EXPLODE_HIGHRATE', 1000);

    define('BATTLE_REASON_NOHP', 0);
    define('BATTLE_REASON_ROUNDMAX', 1);
    define('BATTLE_REASON_FLEE', 2);
    define('BATTLE_REASON_PROPSCHEAT', 3);
    define('BATTLE_REASON_OTHER', 4);

    //animation
    define('BATTLE_BLOCK_V', 0);
    define('BATTLE_BLEED_V', 1);
    define('BATTLE_CRIT_V', 2.0);
    define('BATTLE_END_V', 0);
    define('BATTLE_ANIMATION_N', 50);
    define('BATTLE_ANIMATION_L', 2);
    define('BATTLE_TIMETOZERO_U', 100000);

    /** 行动力属性定义 **/
    define('AP_VALUE', 6);
    define('AP_MAX', 6);
    define('AP_CHANGEVALUE', 1);
    define('AP_CHANGEMAX', 2);
    define('AP_CHANGEINTERVAL', 600);

    //player
    define('PLAYER_SCORE', 150000);
    define('PLAYER_SCORE_MIN', 50000);
    define('PLAYER_INVITECODE_LENGTH', 6);

    //props
    define('PROPS_CP_ID', 1001);
    define('PROPS_LINE_ID', 1002);
    define('PROPS_STONE_ID', 1003);
    define('PROPS_OPERATE_USE', 0);
    define('PROPS_OPERATE_BUY', 1);
    define('PROPS_OPERATE_EXCHANGE', 2);
    define('PROPS_OPERATE_SENT', 3);
    define('PROPS_OPERATE_MAIL', 4);
    define('PROPS_NUM_MAX', 999);

    //mail
    define('MAIL_NOTRECEIVED', 0);
    define('MAIL_RECEIVED', 1);
    define('MAIL_FROM_SYSTEM', 0);
    define('MAIL_FROM_APPSTORE', 1);

    //medal
    define('MEDAL_BATTLE', 1010);
    define('MEDAL_WIN', 1020);
    define('MEDAL_LOSE', 1030);
    define('MEDAL_CONWIN', 1040);
    define('MEDAL_CONLOSE', 1050);
    define('MEDAL_DRAW', 1060);
    define('MEDAL_MAXCOMBO', 1070);
    define('MEDAL_MAXATK', 1080);
    define('MEDAL_MAXDEF', 1090);
    define('MEDAL_DURATION', 1100);
    define('MEDAL_LOGIN', 1110);
    define('MEDAL_WEEKQUEST_S', 2010);
    define('MEDAL_WEEKQUEST_A', 2020);
    define('MEDAL_WEEKQUEST_B', 2030);
    define('MEDAL_WEEKQUEST_C', 2040);
    define('MEDAL_WEEKQUEST_D', 2050);
    define('MEDAL_WEEKQUEST_E', 2060);
    define('MEDAL_WEEKQUEST_F', 2070);
    define('MEDAL_WEEKQUEST_N', 2080);
    define('MEDAL_MONTHQUEST_ATK', 2090);
    define('MEDAL_MONTHQUEST_DEF', 2100);
    define('MEDAL_MONTHQUEST_COMBO', 2110);
    define('MEDAL_GROUPQUEST', 2120);
    
    define('MEDAL_WEEKQUEST_S_BRONZE', 2011);
    define('MEDAL_WEEKQUEST_S_SILVER', 2012);
    define('MEDAL_WEEKQUEST_S_GOLD', 2013);
    define('MEDAL_WEEKQUEST_A_BRONZE', 2021);
    define('MEDAL_WEEKQUEST_A_SILVER', 2022);
    define('MEDAL_WEEKQUEST_A_GOLD', 2023);
    define('MEDAL_WEEKQUEST_B_BRONZE', 2031);
    define('MEDAL_WEEKQUEST_B_SILVER', 2032);
    define('MEDAL_WEEKQUEST_B_GOLD', 2033);
    define('MEDAL_WEEKQUEST_C_BRONZE', 2041);
    define('MEDAL_WEEKQUEST_C_SILVER', 2042);
    define('MEDAL_WEEKQUEST_C_GOLD', 2043);
    define('MEDAL_WEEKQUEST_D_BRONZE', 2051);
    define('MEDAL_WEEKQUEST_D_SILVER', 2052);
    define('MEDAL_WEEKQUEST_D_GOLD', 2053);
    define('MEDAL_WEEKQUEST_E_BRONZE', 2061);
    define('MEDAL_WEEKQUEST_E_SILVER', 2062);
    define('MEDAL_WEEKQUEST_E_GOLD', 2063);
    define('MEDAL_WEEKQUEST_F_BRONZE', 2071);
    define('MEDAL_WEEKQUEST_F_SILVER', 2072);
    define('MEDAL_WEEKQUEST_F_GOLD', 2073);
    define('MEDAL_WEEKQUEST_N_BRONZE', 2081);
    define('MEDAL_WEEKQUEST_N_SILVER', 2082);
    define('MEDAL_WEEKQUEST_N_GOLD', 2083);
    define('MEDAL_MONTHQUEST_ATK_BRONZE', 2091);
    define('MEDAL_MONTHQUEST_ATK_SILVER', 2092);
    define('MEDAL_MONTHQUEST_ATK_GOLD', 2093);
    define('MEDAL_MONTHQUEST_DEF_BRONZE', 2101);
    define('MEDAL_MONTHQUEST_DEF_SILVER', 2102);
    define('MEDAL_MONTHQUEST_DEF_GOLD', 2103);
    define('MEDAL_MONTHQUEST_COMBO_BRONZE', 2111);
    define('MEDAL_MONTHQUEST_COMBO_SILVER', 2112);
    define('MEDAL_MONTHQUEST_COMBO_GOLD', 2113);
    define('MEDAL_GROUPQUEST_BRONZE', 2121);
    define('MEDAL_GROUPQUEST_SILVER', 2122);
    define('MEDAL_GROUPQUEST_GOLD', 2123);

    //Quest
    define('WEEKQUEST_S_POPULATION', 100);
    define('WEEKQUEST_A_POPULATION', 400);
    define('WEEKQUEST_B_POPULATION', 1600);
    define('WEEKQUEST_C_POPULATION', 6400);
    define('WEEKQUEST_D_POPULATION', 25600);
    define('WEEKQUEST_E_POPULATION', 102400);
    define('WEEKQUEST_F_POPULATION', 409600);

    //News
    define('PLAYERNEWS_DEVIDE', 50000);

    //IAP
    define('IAP_PRODUCT_CP1', 101);
    define('IAP_PRODUCT_CP6', 102);
    define('IAP_PRODUCT_CP12', 103);
    define('IAP_PRODUCT_LINE', 201);
    define('IAP_PRODUCT_STONE', 301);

    //robot
    define('ROBOT_PLAYERID', 0);

    //app
    define('APP_VERSION_VERIFY', '1.0');

    //arms
    define('ARM_SWORD_ID', 1);
    define('ARM_ARROW_ID', 2);
    define('ARM_ARRIVAL_ID', 3);
    define('ARM_TANK_ID', 4);
    define('ARM_RANGE_ID', 5);
    define('ARM_HEAL_ID', 6);
    define('ARM_DOT_ID', 7);
    define('ARM_MAGIC_ID', 8);
    define('ARM_STRONG_ID', 9);

    //skills
    define('SKILL_EXP_ID', 1);
    define('SKILL_GOLD_ID', 2);
    define('SKILL_PROPS_ID', 3);
    define('SKILL_MAXHP_ID', 4);
    define('SKILL_HP_ID', 5);
    define('SKILL_VELOCITY_ID', 6);
    define('SKILL_ARMOR_ID', 7);
    define('SKILL_MAXMP_ID', 8);
    define('SKILL_MP_ID', 9);
    define('SKILL_SAVEHP_ID', 10);
    define('SKILL_RAISEFOOD_ID', 11);
    define('SKILL_MAXFOOD_ID', 12);
    define('SKILL_REDUCEPRODUCE_ID', 13);
    define('SKILL_SPEED_ID', 14);
    define('SKILL_ATTACK_ID', 15);
    define('SKILL_DEFENCE_ID', 16);
    define('SKILL_FREQUENCY_ID', 17);
    define('SKILL_PROBABILITY_ID', 18);
    define('SKILL_RANGE_ID', 19);
    define('SKILL_HEALSOLDIER_ID', 20);
    define('SKILL_STRONGATK_ID', 21);
    define('SKILL_WEAPON_ID', 22);
    define('SKILL_RING_ID', 23);

    //sticks
    define('SCEPTER_FISH_ID', 101);
    define('SCEPTER_CURE_ID', 102);
    define('SCEPTER_STAR_ID', 103);
    define('SCEPTER_FIRE_ID', 104);
    define('SCEPTER_DISASTER_ID', 105);
    define('SCEPTER_WIND_ID', 106);
    define('SCEPTER_FOOD_ID', 107);
    define('SCEPTER_FLASH_ID', 108);
    define('SCEPTER_POISON_ID', 109);
    define('SCEPTER_GOLD_ID', 110);
    define('SCEPTER_MAN_ID', 111);
    define('SCEPTER_WOMAN_ID', 112);

    //rings
    define('RING_REBORN_ID', 201);
    define('RING_AGI_ID', 202);
    define('RING_PLANT_ID', 203);
    define('RING_TREASURE_ID', 204);
    define('RING_EXP_ID', 205);
    define('RING_HP_ID', 206);
    define('RING_MP_ID', 207);
    define('RING_PRAY_ID', 208);
    define('RING_SAVE_ID', 209);
