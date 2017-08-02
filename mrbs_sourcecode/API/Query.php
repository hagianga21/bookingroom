<?php
class Query
{

    private $inserting = null;
    private $updating = null;
    private $deleting = null;
    private $getting = null;

    /**
     * Query constructor.
     * @param $inserting [optional]
     * @param $updating [optional]
     * @param $deleting [optional]
     * @param $getting [optional]
     */
    public function __construct(IInserting $inserting = null,IUpdating $updating = null, IDeleting $deleting = null, IGetting $getting = null)
    {
        $this->inserting = $inserting;
        $this->updating = $updating;
        $this->deleting = $deleting;
        $this->getting = $getting;
    }


    /**
     * @return mixed
     */
    public function Insert($data)
    {
        if($this->inserting==null)
        {
            throw new \Exception("Inserting object is null");

        }
        return $this->inserting->insert($data);
    }

    /**
     * @param mixed $inserting
     */
    public function setInserting(IInserting $inserting)
    {
        $this->inserting = $inserting;
    }

    /**
     * @return mixed
     */
    public function update($data,$where)
    {
        return $this->updating->update($data,$where);
    }

    /**
     * @param mixed $updating
     */
    public function setUpdating(IUpdating $updating)
    {
        $this->updating = $updating;
    }

    /**
     * @return mixed
     */
    public function delete($where)
    {
        return $this->deleting->delete($where);
    }

    /**
     * @param mixed $deleting
     */
    public function setDeleting(IDeleting $deleting)
    {
        $this->deleting = $deleting;
    }

    /**
     * @return mixed
     */
    public function select($string_condion,$string_value_expected="*")
    {

        return $this->getting->get_data_field_by_condition($string_condion,$string_value_expected);
    }

    public function selectList($string_condition, $string_value_expected="*")
    {
        return $this->getting->get_list_field_by_condition($string_condition, $string_value_expected);
    }

    public function selectAll($string_value_expected="*")
    {
        return $this->getting->get_all_data($string_value_expected);
    }

    /**
     * @param mixed $getting
     */
    public function setGetting(IGetting $getting)
    {
        $this->getting = $getting;
    }



}
