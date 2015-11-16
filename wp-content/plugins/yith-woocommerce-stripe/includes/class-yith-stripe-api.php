<?php
/**
 * Created by PhpStorm.
 * User: YourInspiration
 * Date: 20/02/2015
 * Time: 16:54
 */

use \Stripe\Stripe;
use \Stripe\Charge;
use \Stripe\Error;
use \Stripe\Customer;

class YITH_Stripe_API {

	protected $private_key = '';

	/**
	 * Set the Stripe library
	 *
	 * @param $key
	 * @since 1.0.0
	 */
	public function __construct( $key ) {
		include_once( 'third-party/stripe.php' );

		$this->private_key = $key;
		Stripe::setApiKey( $this->private_key );
	}

	/**
	 * Create the charge
	 *
	 * @param $params
	 *
	 * @since 1.0.0
	 * @return Charge
	 */
	public function charge( $params ) {
		return Charge::create( $params, array(
			'idempotency_key' => self::generateRandomString(),
		) );
	}

	/**
	 * Retrieve the charge
	 *
	 * @param $transaction_id
	 *
	 * @return Charge
	 * @since 1.0.0
	 */
	public function get_charge( $transaction_id ) {
		return Charge::retrieve( $transaction_id );
	}

	/**
	 * Capture a charge
	 *
	 * @param $transaction_id
	 *
	 * @return Charge
	 * @since 1.0.0
	 */
	public function capture_charge( $transaction_id ) {
		$charge = $this->get_charge( $transaction_id );

		// exist if already captured
		if ( ! $charge->captured ) {
			$charge->capture();
		}

		return $charge;
	}

	/**
	 * Perform a refund
	 *
	 * @param $transaction_id
	 * @param $params
	 *
	 * @since 1.0.0
	 * @return Charge
	 */
	public function refund( $transaction_id, $params ) {
		$deposit = $this->get_charge( $transaction_id );
		return $deposit->refunds->create( $params );
	}

	/**
	 * New customer
	 *
	 * @param $params
	 *
	 * @since 1.0.0
	 * @return Customer
	 */
	public function create_customer( $params ) {
		return Customer::create( $params );
	}

	/**
	 * Retrieve customer
	 *
	 * @param $customer Customer object or ID
	 *
	 * @since 1.0.0
	 * @return Customer
	 */
	public function get_customer( $customer ) {
		if ( is_a( $customer, '\Stripe\Customer' ) ) {
			return $customer;
		}

		return Customer::retrieve( $customer );
	}

	/**
	 * Update customer
	 *
	 * @param $customer Customer object or ID
	 * @param $params
	 *
	 * @since 1.0.0
	 * @return Customer
	 */
	public function update_customer( $customer, $params ) {
		$customer = $this->get_customer( $customer );

		// edit
		foreach ( $params as $key => $value ) {
			$customer->{$key} = $value;
		}

		// save
		return $customer->save();
	}

	/**
	 * Create a card
	 *
	 * @param $customer Customer object or ID
	 * @param $token
	 *
	 * @return Customer
	 *
	 * @since 1.0.0
	 */
	public function create_card( $customer, $token ) {
		$customer = $this->get_customer( $customer );
		return $customer->sources->create(
			array(
				'card' => $token
			)
		);
	}

	/**
	 * Create a card
	 *
	 * @param $customer Customer object or ID
	 * @param $card_id
	 *
	 * @return Customer
	 *
	 * @since 1.0.0
	 */
	public function delete_card( $customer, $card_id ) {
		$customer = $this->get_customer( $customer );
		$customer_id = $customer->id;

		// delete card
		$customer->sources->retrieve( $card_id )->delete();

		return $this->get_customer( $customer_id );
	}

	/**
	 * Se the default card for the customer
	 *
	 * @param $customer Customer object or ID
	 * @param $card_id
	 *
	 * @return Customer
	 *
	 * @since 1.0.0
	 */
	public function set_default_card( $customer, $card_id ) {
		return $this->update_customer( $customer, array(
			'default_source' => $card_id
		) );
	}

	/**
	 * Delete a card
	 *
	 * @param $customer
	 * @param $params
	 *
	 * @return Customer
	 *
	 * @since 1.0.0
	 */
	public function get_cards( $customer, $params = array( 'limit' => 100 ) ) {
		$customer = $this->get_customer( $customer );

		return $customer->sources->all( $params )->data;
	}

	/**
	 * Genereate a semi-random string
	 *
	 * @since 1.0.0
	 */
	protected static function generateRandomString( $length = 24 ) {
		$characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTU';
		$charactersLength = strlen( $characters );
		$randomString     = '';
		for ( $i = 0; $i < $length; $i ++ ) {
			$randomString .= $characters[ rand( 0, $charactersLength - 1 ) ];
		}

		return $randomString;
	}

}