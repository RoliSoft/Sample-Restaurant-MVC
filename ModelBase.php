<?
/**
 * Represents the base of a model.
 **/
class ModelBase
{

    /**
     * Table name of the inheriting class.
     **/
    private $table;

    /**
     * Fields of the inheriting class.
     **/
    private $fields;

    /**
     * Gets the item with the specified ID.
     **/
    public function get($id)
    {
        $sql = 'select '.join(', ', $this->getFields()).' from '.$this->getTable().' where id = '.$id;
        print $sql;
    }

    /**
     * Gets all the items, with condition if specified.
     **/
    public function getAll($where = null)
    {
        $sql = 'select '.join(', ', $this->getFields()).' from '.$this->getTable();

        if (isset($where)) {
            $sql .= ' where '.$where;
        }

        print $sql;
    }

    /**
     * Sends an update of the model values to the database.
     **/
    public function save()
    {
        $fields = $this->getFields();

        if ($fields[0] == 'id') {
            array_shift($fields);
        }

        // if ID is set, perform an update
        if (isset($this->id)) {
            $sql = 'update '.$this->getTable().' set ';

            foreach ($fields as $field) {
                $sql .= $field.' = ';

                if (is_numeric($this->$field)) {
                    $sql .= $this->$field.', ';
                }
                else {
                    $sql .= '"'.$this->$field.'", ';
                }
            }

            $sql = rtrim($sql, ', ').' where id = '.$this->id.' limit 1';
        }
        // if ID is not set, perform an insert
        else {
            $sql = 'insert into '.$this->getTable().' ('.join(', ', $fields).') values (';

            foreach ($fields as $field) {
                if (is_numeric($this->$field)) {
                    $sql .= $this->$field.', ';
                }
                else {
                    $sql .= '"'.$this->$field.'", ';
                }
            }

            $sql = rtrim($sql, ', ').')';

            // before commit: $this->id = $db->lastInsertId();
        }

        print $sql;
    }

    /**
     * Gets the table name of the inheriting class.
     **/
    private function getTable()
    {
        // return cached if available

        if (isset($this->table)) {
            return $this->table;
        }

        // whip out the reflection engine

        $this->table = strtolower(get_class($this));

        return $this->table;
    }

    /**
     * Gets the fields of the inheriting class.
     **/
    private function getFields()
    {
        // return cached if available

        if (isset($this->fields)) {
            return $this->fields;
        }

        // whip out the reflection engine

        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
        $this->fields = [];

        // filter out the base class and return

        foreach ($properties as $property) {
            if ($property->class != 'ModelBase') {
                $this->fields[] = $property->name;
            }
        }

        return $this->fields;
    }

}
