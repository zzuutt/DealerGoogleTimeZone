# Dealer Google Time Zone

Uou must install and activate the first unit [Dealer](https://github.com/thelia-modules/Dealer)

This module add a Timezone field

It use the Google TimeZone API for determine the timezone of the dealer

It provides the date and local time of the dealer

useful to determine if it is open

## Installation

### Manually

* Copy the module into ```<thelia_root>/local/modules/``` directory and be sure that the name of the module is DealerGoogleTimeZone.
* Activate it in your thelia administration panel

## Usage

Enter your API key 

There is a link on the configuration page to page Google TimeZone API

an additional tab appears in the dealer module.


## Loop

[dealer-googletimezone]

### Input arguments

|Argument |Description |
|---      |--- |
|**id** | filter by id |
|**dealer_id** | filter by dealer_id |
|**timezone** | filter by timezone |
|**order** | order result by "id","id-reverse","dealer_id","dealer_id-reverse","timezone","timezone-reverse" |

### Output arguments

|Variable           |Description |
|---                |--- |
|$ID                | id |
|$DEALER_ID         | dealer_id |
|TIMEZONE           | timezone |
|DATETIME           | datetime format:'Y-m-d H:i:s' (1)|
|DAY_OF_THE_WEEK    | numeric representation of the day of the week  0 (for Monday) through 6 (for Sunday) (1)|
|DIFF_WITH_GMT      | Difference to Greenwich time (GMT) with colon between hours and minutes (1)|
|SUMMER_TIME_ACTIVED| Whether or not the date is in daylight saving time (1)|
(1) if the timezone is set or else return null

### Exemple

```
{loop type="dealer-googletimezone" name="dealer_googletimezone_loop" dealer_id=1}
    TimeZone : {$TIMEZONE}
    DateTime : {$DATETIME}
    ...
{/loop}
```

[dealer-googletimezone-schedules]

identical to the loop 'deale_-schedules' of module dealer but with the datetime_dealer and max_period parameters in addition


### Input arguments

|Argument           |Description                                                |
|---                |---                                                        |
|**id**             | filter by id                                              |
|**dealer_id**      | filter by dealer                                          |
|**default_period** | filter by default schedule                                |
|**day** 			| filter by day 		                                    |
|**hide_past**      | true or false                                             |
|**closed**         | filter by close schedule                                  |
|**datetime_dealer**| DATETIME see the loop 'dealer-googletimezone'             |
|**max_period**     | number of days                                            |
|**order**          | order result by "id","id-reverse","day","day-reverse"		|


### Output arguments

|Variable       	|Description                |
|---            	|---                        |
|$ID            	| id                        |
|$DEALER_ID    		| Associated Dealer id      |
|$DAY    			| Day value     			|
|$DAY_LABEL   		| Day label					|
|$BEGIN 			| Schedules start 			|
|$END    			| Schedules end 	 	    |
|$PERIOD_BEGIN 		| Schedules period start	|
|$PERIOD_END    	| Schedules period end		|

### Exemple

```
{loop type="dealer-googletimezone" name="dealer_googletimezone_loop" dealer_id=1}
    {loop type="dealer-googletimezone-schedules" name="dealer_googletimezone_schedules_loop" datetime_dealer=£DATETIME hide_past=true max_period='30' dealer_id=1}
        'day': '{$DAY}'
        'day_label': '{$DAY_LABEL}'
        'begin':'{format_date date=$BEGIN output="time"}'
        'end':'{format_date date=$END output="time"}'
        ...
    {/loop}
{/loop}
```

