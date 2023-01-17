<?php

    class Basic_auth
    {
        public function check()
        {
            $headers = $this->input->request_headers();

            if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
                $this->load->model('UserModel');
                list($username, $password) = explode(':', base64_decode(substr($headers['Authorization'], 6)));

                $user = $this->UserModel->authenticate($username, $password);

                if (!$user) {
                    $this->response(array('status' => false, 'error' => 'Invalid username or password'), 401);
                }
            } else {
                $this->response(array('status' => false, 'error' => 'Unauthorized'), 401);
            }
        }
    }