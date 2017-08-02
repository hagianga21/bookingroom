import React, { Component } from 'react';
import {StyleSheet, Text, View, ListView,Image,TouchableHighlight,StatusBar,TouchableOpacity,FlatList } from 'react-native';
import {connect} from 'react-redux';

class Filter extends Component {
    getTextStyle(statusName){
          const {myfilterStatus} = this.props;
          if(statusName === myfilterStatus) return styles.buttonchoosed;
          return styles.buttonText;
    }
    
    setFilterStatus(actionType){
          this.props.dispatch({type: actionType});
    }
    render(){
        return(
            <View style={styles.container}>
                <TouchableOpacity onPress = {() => this.setFilterStatus('FILTER_AVAILABLE_ROOM')}>
                    <Text style ={this.getTextStyle('AVAILABLE_ROOM')}>AVAILABLE</Text>
                </TouchableOpacity>
                <TouchableOpacity onPress = {() => this.setFilterStatus('FILTER_BOOKED_ROOM')}>
                    <Text style ={this.getTextStyle('BOOKED_ROOM')}>BOOKED</Text>
                </TouchableOpacity>
            </View>
        );
  }
}

function mapStateToProps(state){
    return {
        myfilterStatus: state.filterStatus,
        };
}

export default connect(mapStateToProps)(Filter);

const styles = StyleSheet.create({
    container:{
        backgroundColor:'palevioletred',
        flex:1,
        flexDirection:'row',
        alignItems:'center',
        justifyContent:'space-around',
        alignSelf: 'stretch',

    },
    buttonText:{
        color: 'white',
        fontSize:30,
        marginTop: 22,
        marginBottom: 22,
    },
    buttonchoosed:{
        color: 'royalblue',
        fontSize:30,
        fontWeight:'bold',
        marginTop: 22,
        marginBottom: 22,
    }
});
