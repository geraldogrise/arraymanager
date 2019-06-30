<?php

    class ArrayManager{
	    private $group;
		private $expression = false;
		private $sourceList;
		public function getGroup(){
		   return $this->group;
		}
		public function setGroup($group){
		    $this->group = $group;
		}
		public function getExpression(){
		   return $this->$expression;
		}
		public function setExpression($expression){
		    $this->$expression = $expression;
		}
		public function getSourceList(){
		   return $this->sourceList;
		}
		public function setSourceList($sourceList){
		    $this->sourceList = $sourceList;
		}
		public function add(&$list,$object){
		      array_push($list,$object);
			  return $list;
	    }
		public function addFirst(&$list,$object){
		      array_unshift ($list,$object);
			  return $list;
	    }
		public function avg($list,$query,$group){
			  $groupList = $this->groupBy($list,$group);
			  $myReturnList=$this->getAggregation($list,$groupList,$query,$group,"avg");
		     return $myReturnList;
		}
		public function contains($list,$object){
		      $flagC = false;
			  if(in_array($object, $list, false)){
			     $flagC = true;
			  }
			  return $flagC;
		}
		public function count($list,$query,$group){
			  $groupList = $this->groupBy($list,$group);
			  $myReturnList=$this->getAggregation($list,$groupList,$query,$group,"count");
		      return $myReturnList;
		}
		public function getSize($list){
		  $size =  sizeof($list);
		  return $size;
		}
		public function except($list1,$list2){
	        $list = array();
			$class_name = get_class($list1[0]);
			$list =  array_udiff($list1,$list2,array($class_name, "Equals"));
			return $list;
		}
		public function fill($list,$start_index,$num,$object){
			  $list_fill = array_fill($start_index, $num, $object);
			  foreach($list_fill as $value){
			     $this->add($list,$value);
			  }
			  return $list;
		}
		public function first($list){
		  $object =  $list[0];
		  return $object;
		}
		private function frmtString($string){
			if(is_string($string)){
				$string = "'".$string."'";
			}
			return $string;
		}
		private function formatString($exp){
		    $arrayOperators = array("==","!=","<",">","<=",">=","&&","||");
			$exp = str_replace(" == ","@==@",$exp);
			$exp = str_replace(" ","",$exp);
			$exp = str_replace("@==@"," == ",$exp);
			$exp = str_replace("&&"," && ",$exp);
			$words = explode(" ",$exp);
			$separator = "";
			$expression = "";
			foreach($words as $w){
			   if(!in_array($w, $arrayOperators) && !is_numeric($w)){
			      $expression .= $separator.'"'.$w.'"';   
			   }else{
			      $expression .= $separator.$w;   
			   }
			   $separator=" ";
			}
			
			$expression = str_replace("\"\"","",$expression);
			return $expression;
		
		}
		public function getAggregation($list,$groupList,$query,$group,$type){
		   	  $model = array();
			  $myList = array();
			  $class_name = get_class($list[0]);
			  $ref_class = new ReflectionClass($class_name);
			  $listFields = explode(",",$query);
			  $listGroup = explode(",",$group);
			  $expression = '';
			  $separator = '';	
			  $model = array();
			  $groupList = $this->groupBy($list,$query);
			  $element = array();
			  foreach($groupList as $item){
				 $myObject = new $class_name();
				 $whereList = array();
				 $expression = '';
				 $separator = '';
				 foreach($listFields as $key){
					  $fieldGet = "get" .ucfirst($key);
					  $reflectionMethod = new ReflectionMethod($class_name, $fieldGet);
					  $value = $reflectionMethod->invoke( $item);
					  $fieldSet = "set" .ucfirst($key);
					  $reflectionMethod = new ReflectionMethod($class_name, $fieldSet);
					  $reflectionMethod->invokeArgs( $myObject ,[$value] );
					  $expression .=$separator.'$item->get'.ucfirst($key).'() == '.$this->frmtString($value).' ';
					  $separator = ' && ';
					  $whereList = $this->where($list,$expression);
					  if(sizeof($whereList) > 0 ){
						 $ListAggregation = $this->setAggregationList($class_name,$whereList,$listGroup);
						 $myAggreg =$this->setAggegationFunction($ListAggregation,$type,$listGroup);
					  }
					  foreach($ref_class->getProperties() as $property){
						  $fieldGet = "get" .ucfirst($property->getName());
						  $reflectionMethod = new ReflectionMethod($class_name, $fieldGet);
						  $value = $reflectionMethod->invoke( $item);
						  $myList[$property->getName()] = $value;
					  }
					  foreach($myAggreg as $k => $v){
						  $myList[$k] = $v;
					  }
					  array_push($model,$myList);
						  
				 }
			  }
			  return $model;
		}
		
		
		public function groupBy($list,$query){
		   $myList = $this->orderBy($list,$query,"ASC","groupby");
		   $this->setGroup($query);
		   $this->setSourceList($list);
		   return $myList;
		}
		public function inverse($list){
		    $list =array_reverse($list);
			return $list;
		}
		public function intersect($list1,$list2){
	        $list = array();
			$class_name = get_class($list1[0]);
			$list =  array_uintersect($list1,$list2,array($class_name, "Equals"));
			return $list;
		}
		public function max($list,$query,$group){
			  $groupList = $this->groupBy($list,$group);
			  $myReturnList=$this->getAggregation($list,$groupList,$query,$group,"max");
			  return $myReturnList;
		}
		public function min($list,$query,$group){
		      $groupList = $this->groupBy($list,$group);
			  $myReturnList=$this->getAggregation($list,$groupList,$query,$group,"min");
			  return $myReturnList;
		}
		private function ordArray($list,$query){
		    $myReturnList = array();
			$class_name = get_class($list[0]);
			$ref_class = new ReflectionClass($class_name);
			$listFields = explode(",",$query);
			$key_field= "";
			foreach($list as $object){
				   $myList = array();
				   $key_field  = "";
				   $value_field= "";
				   $separator = "";
				   foreach($ref_class->getProperties() as $property)
				   {
						$key = $property->getName();
						$fieldGet = "get" .ucfirst($key);
						$reflectionMethod = new ReflectionMethod($class_name, $fieldGet);
						$value = $reflectionMethod->invoke( $object);
						$myList[$key] = $value;
						if(in_array($key, $listFields)){
							$key_field .= $separator .$key;
							$value_field .= $separator.$value;
							$separator = "_";
						}
				   }
					$myList["chave"] = $value_field;
					array_push($myReturnList,$myList);
				}
			   
			  return $myReturnList;
		
		}
		
		public function orderBy($list,$query,$type ="ASC",$action="orderby"){
			  $myReturnList = array();
			  $class_name = get_class($list[0]);
			  $ref_class = new ReflectionClass($class_name);
			  $listFields = explode(",",$query);
			  $key_field= "";
			  $myReturnList = $this->ordArray($list,$query);
			  $map = function($v) { return  $v["chave"]; };
			  $countArray = array_count_values(array_map($map, $myReturnList));
			  ksort($countArray);
			  if(strtoupper($type) == "DESC"){
			     $countArray = $this->inverse($countArray);
			  }
			  $myList = array();
			  $arrayKeys = array();
			  foreach ($countArray as $key => $value){
				 foreach($myReturnList as $element){
					 if($element["chave"] == $key){
						if(!in_array($key,$arrayKeys) || $action =="orderby"){
						   array_push($arrayKeys,$key);
						   $myObject = new $class_name();
						   foreach($ref_class->getProperties() as $property){
							 $fieldSet = "set" .ucfirst($property->getName());
							 $reflectionMethod = new ReflectionMethod($class_name, $fieldSet);
							 $reflectionMethod->invokeArgs( $myObject ,[$element[$property->getName()]] );
						   }
							array_push($myList,$myObject);
					    }else{
						   
						  
						}
					 }
				 }
			  }
			  return $myList;
		}
		public function product($list,$query,$group){
		      $groupList = $this->groupBy($list,$group);
			  $myReturnList=$this->getAggregation($list,$groupList,$query,$group,"product");
			  return $myReturnList;
		}
		
		public function last($list){
		  $object =  $list[sizeof($list)-1];
		  return $object;
		}
		public function removeBy($list,$expression){
		   $myReturnList = array();
		   $class_name = get_class($list[0]);
		   $item  =  new $class_name();
		   $ref_class = new ReflectionClass($class_name);
		   $expression= str_replace("\$","{\$",$expression);
	       $expression= str_replace("()","()}",$expression);
		    foreach($list as $item){
			   $myObject = new $class_name();
               $exp = eval("return<<<END\n$expression\nEND;\n");
			    if( eval('return '.$exp.';')){
			      
			        foreach($ref_class->getProperties() as $key){
					   $fieldGet = "get" .ucfirst($key->getName());
					   $reflectionMethod = new ReflectionMethod($class_name, $fieldGet);
					   $value = $reflectionMethod->invoke( $item);
					   $fieldSet = "set" .ucfirst($key->getName());
					   $reflectionMethod = new ReflectionMethod($class_name, $fieldSet);
					   $reflectionMethod->invokeArgs( $myObject ,[$value] );
					}
				    array_push($myReturnList,$myObject);
				}
		   }
		   return $myReturnList;
		}
		public function removeFirst(&$list){
		      $element = array_shift($list);
			  return $element;
	    }
		public function removeLast(&$list){
		      $element = array_pop($list);
			  return $element;
	    }
		public function select($list,$query){
		   $myReturnList = array();
		   $class_name = get_class($list[0]);
		   $listFields = explode(",",$query);
		   foreach($list as $object){
			   $myObject = new $class_name();
			   foreach($listFields as $key){
			       $fieldGet = "get" .ucfirst($key);
				   $reflectionMethod = new ReflectionMethod($class_name, $fieldGet);
				   $value = $reflectionMethod->invoke( $object);
				   $fieldSet = "set" .ucfirst($key);
				   $reflectionMethod = new ReflectionMethod($class_name, $fieldSet);
				   $reflectionMethod->invokeArgs( $myObject ,[$value] );
			    }
				 array_push($myReturnList,$myObject);
		   }
		   return $myReturnList;
		}
		public function setAggregationList($class_name,$whereList,$listGroup){
			$ListAggregation = array();
			foreach($whereList as $objItem){
				foreach($listGroup as $field){
			       $fieldGet = "get" .ucfirst($field);
		           $reflectionMethod = new ReflectionMethod($class_name, $fieldGet);
		           $value = $reflectionMethod->invoke($objItem);
				   $myListAggregation[$field] = $value;
		        }
				 array_push($ListAggregation,$myListAggregation);
			}
			
			return $ListAggregation;
			
		}
		public function setAggegationFunction($ListAggregation,$type,$listFields){
		    $myList = array();
			foreach($listFields as $field){
				switch($type){
				   case "avg":
					 $myList["avg_".$field] =  array_sum(array_column($ListAggregation, $field))/count(array_column($ListAggregation, $field));
				   break;
				   case "count":
					  $myList["count_".$field] = count(array_column($ListAggregation, $field));
				   break;
				   case "max":
					 $myList["max_".$field] = max(array_column($ListAggregation, $field));
				   break;
				   case "min":
				      $myList["min_".$field] = min(array_column($ListAggregation, $field));
				   break;
				   case "product":
					 $myList["prod_".$field] = array_product(array_column($ListAggregation, $field));
				   break;
				   case "sum":
					 $myList["sum_".$field] = array_sum(array_column($ListAggregation, $field));
				   break;
				}				
			}
			return $myList;
			
		} 
		public function slice(&$list,$offset,$length){
		      $output = array();
			  if($length !=""){
			   $output = array_slice ($list,$offset,$length);
			  }
			  else{
			    $output = array_slice ($list,$offset);
			  }
			  
			  return $output;
	    }
		public function sort($list){
		    $class_name = get_class($list[0]);
			uasort($list,array($class_name, "Equals"));
			return $list;
		}
		public function sum($list,$query,$group){
			  $groupList = $this->groupBy($list,$group);
			  $myReturnList=$this->getAggregation($list,$groupList,$query,$group,"sum");
		      return $myReturnList;
		}
		public function union($list1,$list2){
	        $list = array();
			$class_name = get_class($list1[0]);
			$list =  array_merge($list1,$list2);
			return $list;
		}
		public function unionDistinct($list1,$list2){
	        $list = array();
			$class_name = get_class($list1[0]);
			$list =  array_merge($list1,$list2);
			$list = array_unique($list);
			return $list;
		}
		public function where($list,$expression){
		   $myReturnList = array();
		   $class_name = get_class($list[0]);
		   $item  =  new $class_name();
		   $ref_class = new ReflectionClass($class_name);
		   $expression= str_replace("\$","\"{\$",$expression);
	       $expression= str_replace("()","()}\"",$expression);
		   foreach($list as $item){
			   $myObject = new $class_name();
			  
			   $exp = eval("return<<<END\n$expression\nEND;\n");
			   if( eval('return '.$exp.';')){
			        foreach($ref_class->getProperties() as $key){
					   $fieldGet = "get" .ucfirst($key->getName());
					   $reflectionMethod = new ReflectionMethod($class_name, $fieldGet);
					   $value = $reflectionMethod->invoke( $item);
					   $fieldSet = "set" .ucfirst($key->getName());
					   $reflectionMethod = new ReflectionMethod($class_name, $fieldSet);
					   $reflectionMethod->invokeArgs( $myObject ,[$value] );
					}
				    array_push($myReturnList,$myObject);
				}
		   }
		   return $myReturnList;
		}
		
		
		
		
		
		
		
		
	
	}


?>
