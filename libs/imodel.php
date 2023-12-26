<?php
  /**
    * Interface nos permite definir metodos que despues son implementados como una clase modelo
    * @access public
    * save();
    * getAll();
    * get($id);
    * delete($id);
    * update();
    * from($array);
  */
  interface IModel{
    
    /**
       * Guarda la informacion de la tabla en la db dependiendo del model a que pertenezca 
       * @return boolean 
    */
    public function save();
    
    /**
       * obtiene todas las filas de una tala en la base de datos 
       * @param string 
       * @return boolean 
    */
    public function getAll();
    
    /**
       * obtiene una fila de una tabla de la base de datos por medio de id 
       * @param string 
       * @return boolean 
    */
    public function get($id);
    
    /**
       * elimina una fila de la tabla en la db dependiendo del model a que pertenezca 
       *  @param string 
       * @return boolean 
    */
    public function delete($id);
    
    /**
       * actualiza un dato de fila en la tabla dependiendo del model a que pertenezca 
       * @param string id
       * @return boolean 
    */
    public function update();
    
    /**
       * devuelve los datos this de la clase
       * @param array 
       * @return this
    */
    public function from($array);
  }


?>
