<?php
class api {
    protected $base_url;
    protected $api_key;

    public function __construct($base_url, $api_key) {
        $this->base_url = $base_url;
        $this->api_key = $api_key;
    }

    public function call($path, $data = array()) {
        if($data)
            $data['submitted'] = 'submitted';

        $opts = array(
            'http' => array(
                'method' =>  'GET',
                'header' => 'Accept: application/json',
                'content' => http_build_query($data),
            )
        );

        $path = $this->base_url.'?path_info='.$path.'&token='.$this->api_key;

        echo $path;
        die;
        return json_decode(file_get_contents($path, FALSE, stream_context_create($opts)));
    }

    public function create_project($name, $leader_id) {
        return $this->call('/projects/add', array('project' => array('name' => $name, 'leader_id' => $leader_id)));
    }

    public function add_ticket($project_id, $name) {
        return $this->call("/projects/{$project_id}/tickets/add", array('ticket' => array('name' => $name)));
    }

    public function projects() {
        return $this->call('invoices');
    }

    public function info() {
        return $this->call('/info');
    }
}

