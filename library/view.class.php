<?php
    final class View
    {
        private $_storage;
        private $_templatePath;

        public function __construct($templatePath)
        {
            $this->_templatePath = $templatePath;
        }

        public function render($template)
        {
            if(is_array($template))
                foreach($template as $file)
                    $this->renderBlock($file);
            else
                $this->renderBlock($template);
        }

        private function renderBlock($template)
        {
            if(file_exists($this->_templatePath . $template))
                include $this->_templatePath . $template;
            else
                die('TODO: Throw error for missing template file:' . $template);
        }

        public function json($mixed)
        {
            echo json_encode($mixed);
        }

        final public function __set($index, $value)
        {
            $this->_storage[$index] = $value;
        }

        final public function __get($index)
        {
            if(isset($this->_storage[$index]))
                return $this->_storage[$index];

            return null;
        }
    }
