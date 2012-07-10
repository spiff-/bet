<?php 
	class template{

		private $fd;
		private $file;
		private $fileNanme;
		private $vars;
	
        function __construct($name){
                $this->fileName = 'templates/' . $name . '.tpl';
                
                 if (!($this->fd = @fopen($this->fileName, 'r')))
                        throw new Exception('Error al abrir la plantilla ' . $name);
        }
        
	    function addVar($name, $value){
	    	$this->vars[$name] = $value;
	    }        

	    function addVars($vars){
                $this->vars = (empty($this->vars)) ? $vars : $this->vars . $vars;
        }
        
        function display(){
                if ($this->fd) {
                        $this->file = fread($this->fd, filesize($this->fileName));
                        fclose($this->fd);
                        
                        $this->file = str_replace("'", "\'", $this->file);
                        $this->file = preg_replace('#\{([a-z0-9\-_]*?)\}#is', "' . $\\1 . '", $this->file);
                        
                        reset($this->vars);
                        while(list($key, $val) = each($this->vars)) {
                                $$key = $val;
                        }
                        eval("\$this->file = '$this->file';");
                        
                        reset ($this->vars);
                        while (list($key, $val) = each($this->vars)) {
                                unset($$key);
                        }
                        
                        $this->file = str_replace("\'", "'", $this->file);
                        echo $this->file;
                }
        }
	}

?>
