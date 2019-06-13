<?php

use JsonSchema\Validator;
use JsonSchema\SchemaStorage;
use JsonSchema\Constraints\Factory;

use classes\APITestCase;
use classes\APITestUtils;

class user_get extends APITestCase {
	use traits\TestIsResponseCode200;
	use traits\TestIsResponseContentTypeJSON;

	public function setUp(): void {
		parent::setUp();

		$this->set_endpoint_method('GET');
		$this->set_endpoint_uri('user/user_get.php');
	}

	public function test_is_response_output_schema_correct(): void {
		$this->api->login('admin', 'admin');
		$resp = $this->api->call(
			$this->get_endpoint_method(),
			$this->get_endpoint_uri(),
			['user' => 'admin'],
			[],
			TRUE
		);

		$schema = APITestUtils::read_json_file(
			dirname(__FILE__).'/schemas/user_get.schema.json'
		);

		$validator = new Validator();
		$validator->validate($resp, $schema);

		$this->assert_json_validator_valid($validator);
		$this->api->logout();
	}

	public function test_invalid_request_error_with_missing_user_parameter(): void {
		$this->api->login('admin', 'admin');
		$resp = $this->api->call(
			$this->get_endpoint_method(),
			$this->get_endpoint_uri(),
			[],
			[],
			TRUE
		);

		$this->assert_api_errored(
			$resp,
			$this->api->get_error_code('API_E_INVALID_REQUEST')
		);
		$this->api->logout();
	}

	public function test_invalid_request_error_with_nonexistent_user(): void {
		$this->api->login('admin', 'admin');
		$resp = $this->api->call(
			$this->get_endpoint_method(),
			$this->get_endpoint_uri(),
			['user' => 'nouser'],
			[],
			TRUE
		);		

		$this->assert_api_errored(
			$resp,
			$this->api->get_error_code('API_E_INVALID_REQUEST')
		);
		$this->api->logout();
	}

	public function test_invalid_request_error_with_empty_user_parameter(): void {
		$this->api->login('admin', 'admin');
		$resp = $this->api->call(
			$this->get_endpoint_method(),
			$this->get_endpoint_uri(),
			['user' => ''],
			[],
			TRUE
		);		

		$this->assert_api_errored(
			$resp,
			$this->api->get_error_code('API_E_INVALID_REQUEST')
		);
		$this->api->logout();
	}

	public function test_endpoint_not_authorized_for_non_admin_users(): void {
		$this->api->login('user', 'user');
		$resp = $this->api->call(
			$this->get_endpoint_method(),
			$this->get_endpoint_uri(),
			['user' => 'admin'],
			[],
			TRUE
		);		

		$this->assert_api_errored(
			$resp,
			$this->api->get_error_code('API_E_NOT_AUTHORIZED')
		);
		$this->api->logout();
	}
}
