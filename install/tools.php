<?php
/*
 * WiND - Wireless Nodes Database
 *
 * Copyright (C) 2005-2014 	by WiND Contributors (see AUTHORS.txt)
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */


$_GLOBALS['root_path'] = dirname(__FILE__) . '/../';

//! Create an absolute url for static content
function surl($relative)
{
    return (dirname($_SERVER['SCRIPT_NAME']) != '/'? dirname($_SERVER['SCRIPT_NAME']):'') . $relative;
}

function abs_surl($absolute)
{
	$scheme = (isset($_SERVER['HTTPS']))?'https':'http';
	return "$scheme://{$_SERVER['HTTP_HOST']}" . $absolute;
}

//! Return textual represenetation of result.
function result_text($result)
{
	return (!$result?'fail':'success');
}


function show_error($message)
{
	echo "<div class=\"error\">$message</div>";
}

//! Check if request method is port
function is_method_post()
{
	return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function installation_session()
{
	/*
	 * Begin session
	 */
	session_start();
	define('ROOT_PATH', './');
	if (!isset($_SESSION['config'])) {
		require_once(dirname(__FILE__) . '/../config-sample/config.php');
		$_SESSION['config'] = $config;
	
		// Add url staf
		$_SESSION['config']['site']['domain'] = $_SERVER['HTTP_HOST'];
		
		$absolute = explode('/', surl('/'));
		array_splice($absolute, -2);
		$absolute = implode('/', $absolute ) . '/';
		$_SESSION['config']['site']['url'] = abs_surl($absolute );	
	}
}

function get_next_step($steps, $current)
{
	$step_keys = array_keys($steps);
	$step_current_index = array_search($current, $step_keys);
	return isset($step_keys[$step_current_index + 1])?$step_keys[$step_current_index + 1]:null;
}
<?xml version="1.0" encoding="utf-8"?>
<manifest xmlns:android="http://schemas.android.com/apk/res/android"
package="org.teameos.settings.device"
android:sharedUserId="android.uid.system"
android:versionCode="2"
android:versionName="2.0" >
<uses-sdk
android:minSdkVersion="15"
android:targetSdkVersion="16" />
<uses-permission android:name="android.permission.READ_PHONE_STATE" />
<uses-permission android:name="android.permission.MODIFY_PHONE_STATE" />
<uses-permission android:name="android.permission.HARDWARE_TEST" />
<uses-permission android:name="android.permission.WRITE_EXTERNAL_STORAGE" />
<uses-permission android:name="android.permission.READ_EXTERNAL_STORAGE" />
<uses-permission android:name="android.permission.WRITE_SETTINGS" />
<uses-permission android:name="android.permission.WRITE_SECURE_SETTINGS" />
<application
android:icon="@drawable/ic_launcher"
android:label="@string/title_activity_device_settings"
android:theme="@style/AbsVpiTheme" >
<activity
android:name=".DeviceSettings"
android:label="@string/title_activity_device_settings" >
<intent-filter>
<action android:name="android.intent.action.MAIN" />
<category android:name="android.intent.category.LAUNCHER" />
</intent-filter>
</activity>
<service
android:name=".PhoneService"
android:exported="false"
android:process="com.android.phone" >
<intent-filter>
<action android:name="android.intent.action.MAIN" />
<category android:name="android.intent.category.DEFAULT" />
</intent-filter>
</service>
</application>
</manifest>
