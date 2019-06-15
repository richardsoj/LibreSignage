<?php

use JsonSchema\Validator;
use classes\APITestCase;
use classes\APITestUtils;

class users_list extends APITestCase {
	use traits\TestEndpointNotAuthorizedWithoutLogin;
	use traits\TestIsResponseCode200;
	use traits\TestIsResponseContentTypeJSON;

	public function setUp(): void {
		parent::setUp();

		$this->set_endpoint_method('GET');
		$this->set_endpoint_uri('user/users_list.php');
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
		$this->assert_valid_json(
			$resp,
			dirname(__FILE__).'/schemas/users_list.schema.json'
		);

		$this->api->logout();
	}
}
