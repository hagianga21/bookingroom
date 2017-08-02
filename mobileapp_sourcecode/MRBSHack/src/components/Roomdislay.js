import React,{Component} from 'react';
import {View, Text ,StyleSheet,FlatList} from 'react-native';
//import Triangle from 'react-native-triangle';
import {connect} from 'react-redux';

class Roomdislay extends Component{
    render(){
        const {room_name,bookedstatus} = this.props.roomname;
        
        const dislaybox  = bookedstatus === "true" ? styles.boxlightgreen : styles.boxgreen;
        const dislaytriangle  = bookedstatus === "true" ? styles.triangle : styles.nothing;
        return(
            <View style = {dislaybox}>
                <Text style = {{fontWeight:'bold', color: 'white'}}>{room_name}</Text>
                <View style = {dislaytriangle}/>
            </View>
        );
    }
}


export default connect()(Roomdislay);

const styles = StyleSheet.create({
  boxgreen:{
    flexDirection:'row',
    width:111,
    height:50,
    backgroundColor:'#008B00',
    margin:2,
    borderRadius:5,
    justifyContent: 'center',
    alignItems: 'center',
  },
  boxlightgreen:{
    flexDirection:'row',
    width:111,
    height:50,
    backgroundColor:'mediumseagreen',
    margin:2,
    borderRadius:5,
    justifyContent: 'center',
    alignItems: 'center',
  },
  triangle:{
    position:'absolute',
    right:0,
    bottom:0,  
    width: 0,
    height: 0,
    backgroundColor: 'transparent',
    borderStyle: 'solid',
    borderRightWidth: 20,
    borderTopWidth: 20,
    borderRightColor: 'transparent',
    borderTopColor: 'orange',
    transform: [
      {rotate: '180deg'}
    ]
  },
  nothing:{},
});