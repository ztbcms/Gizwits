<?php

/**
 * author: Jayin <tonjayin@gmail.com>
 */

namespace Gizwits\Entity;

class GizwitsConfig {


    private $product_key;
    private $product_secret;
    private $phone_id;
    private $app_id;
    private $app_secret;
    private $user_token;
    private $user_token_expire_at;
    private $frequency_sync_dev;
    private $is_default;

    public function __construct() {

    }

    /**
     * @return mixed
     */
    public function getProductKey() {
        return $this->product_key;
    }

    /**
     * @param mixed $product_key
     */
    public function setProductKey($product_key) {
        $this->product_key = $product_key;
    }

    /**
     * @return mixed
     */
    public function getProductSecret() {
        return $this->product_secret;
    }

    /**
     * @param mixed $product_secret
     */
    public function setProductSecret($product_secret) {
        $this->product_secret = $product_secret;
    }

    /**
     * @return mixed
     */
    public function getPhoneId() {
        return $this->phone_id;
    }

    /**
     * @param mixed $phone_id
     */
    public function setPhoneId($phone_id) {
        $this->phone_id = $phone_id;
    }

    /**
     * @return mixed
     */
    public function getAppId() {
        return $this->app_id;
    }

    /**
     * @param mixed $app_id
     */
    public function setAppId($app_id) {
        $this->app_id = $app_id;
    }

    /**
     * @return mixed
     */
    public function getAppSecret() {
        return $this->app_secret;
    }

    /**
     * @param mixed $app_secret
     */
    public function setAppSecret($app_secret) {
        $this->app_secret = $app_secret;
    }

    /**
     * @return mixed
     */
    public function getUserToken() {
        return $this->user_token;
    }

    /**
     * @param mixed $user_token
     */
    public function setUserToken($user_token) {
        $this->user_token = $user_token;
    }

    /**
     * @return mixed
     */
    public function getUserTokenExpireAt() {
        return $this->user_token_expire_at;
    }

    /**
     * @param mixed $user_token_expire_at
     */
    public function setUserTokenExpireAt($user_token_expire_at) {
        $this->user_token_expire_at = $user_token_expire_at;
    }

    /**
     * @return mixed
     */
    public function getFrequencySyncDev() {
        return $this->frequency_sync_dev;
    }

    /**
     * @param mixed $frequency_sync_dev
     */
    public function setFrequencySyncDev($frequency_sync_dev) {
        $this->frequency_sync_dev = $frequency_sync_dev;
    }

    /**
     * @return mixed
     */
    public function getisDefault() {
        return $this->is_default;
    }

    /**
     * @param mixed $is_default
     */
    public function setIsDefault($is_default) {
        $this->is_default = $is_default;
    }

}