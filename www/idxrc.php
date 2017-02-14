<?php


$environments = array(
    'test' => array(
        'hosts' => array('127.0.0.1'),
        'ssh_params' => array('user' => 'vagrant'),
        'deploy' => array(
            'repository' => 'git@github.com:ideatosrl/tiptapp.git',
            'branch' => 'origin/master',
            'shared_files' => array('backend/app/config/parameters.yml'),
//            'shared_folders' => array('backend/app/cache', 'backend/app/logs'),
            'remote_base_dir' => '/var/www/testidx',
            'rsync_exclude' => './rsync_exclude.txt',
        )
    ),
);

return
    array(
        'envs' => $environments,
        'ssh_client' => new \Idephix\SSH\SshClient(),
        'extensions' => array(
            'rsync' => new \Idephix\Extension\Project\Rsync(),
        ),
    );




