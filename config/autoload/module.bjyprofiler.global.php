<?php

return array(
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => function  ($sm)
            {
                $appConfig = $sm->get('Config');
                $dbParams = $appConfig['db'];
                $adapter = new BjyProfiler\Db\Adapter\ProfilingAdapter($dbParams);
                $adapter->setProfiler(new BjyProfiler\Db\Profiler\Profiler());
                if (isset($dbParams['options']) && is_array($dbParams['options'])) {
                    $options = $dbParams['options'];
                }
                else {
                    $options = array();
                }
                $adapter->injectProfilingStatementPrototype($options);
                return $adapter;
            }
        )
    )
);