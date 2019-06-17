<?php

use JsonSchema\Validator;
use classes\APITestCase;
use classes\APITestUtils;

class users_get_all extends APITestCase {
	use traits\TestEndpointNotAuthorizedWithoutLogin;

	public function setUp(): void {
		parent::setUp();

		$this->set_endpoint_method('GET');
		$this->set_endpoint_uri('user/users_get_all.php');
	}

	public function test_endpoint_not_authorized_for_non_admin_users(): void {
		$this->api->login('user', 'user');

		$resp = $this->api->call(
			$this->get_endpoint_method(),
			$this->get_endpoint_uri(),
			[],
			[],
			TRUE
		);
		$this->assert_api_failed($resp, 'API_E_NOT_AUTHORIZED');

		$this->api->logout();
	}

	public function test_is_response_schema_correct(): void {
		$this->api->login('admin', 'admin');

		$resp = $this->api->call(
			$this->get_endpoint_method(),
			$this->get_endpoint_uri(),
			[],
			[],
			TRUE
		);
		$this->assert_object_matches_schema(
			$resp,
			dirname(__FILE__).'/schemas/users_get_all.schema.json'
		);

		$this->api->logout();
	}
}
