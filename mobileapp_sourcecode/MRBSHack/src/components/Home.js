import React, { Component } from 'react';
import {StyleSheet, Text, View, ListView,Image,TouchableHighlight,StatusBar,TouchableOpacity,FlatList, RefreshControl} from 'react-native';
import { Header, Icon } from 'react-native-elements';
import {connect} from 'react-redux';
import Roomdislay from './Roomdislay';
import {fetchData,filterRoom} from './Action';


const FETCH_SUCCESS = "Empty Rooms";
const FETCH_ERROR = "It looks like there is a problem with your connection to the server. Please contact network administrator for more information!";
const FETCH_REQUEST = "Loading...";
class Home extends Component {
    constructor(props){
        super(props);
       var timeID = 0;
        this.state = {
            roomData: null,
            refreshing: false,
            fetchStatus: FETCH_REQUEST,
        };
    }
   
    getRoomList(){
        const {myFilter, myRooms} = this.props;
        if(myFilter === 'AVAILABLE_ROOM') return myRooms.filter(e => e.humanstatus === "false");
    };


    fetchData() 
    {
        
        fetch('http://192.168.122.26/mrbs_sourcecode/API/Demo/APIController.php', {timeout: 2000})
            .then((response) => response.json())
            .then((responseData) => {
                    this.setState({roomData: responseData.API,fetchStatus: FETCH_SUCCESS});
                    this.props.dispatch(fetchData(this.state.roomData));
                    
            })
            .catch((error) => {
                this.setState({fetchStatus: FETCH_ERROR});})
            .done();
    }

   _onRefresh() { 
        this.setState({refreshing: true,fetchStatus: FETCH_REQUEST});
        this.fetchData();
        this.setState({refreshing: false});
    }

    componentDidMount()
    {
        this.setState({fetchStatus: FETCH_REQUEST});
        this.fetchData();
    }

    getTextStyle(statusName){
          const {myFilter} = this.props;
          if(statusName === myFilter) return styles.buttonchoosed;
          return styles.buttonText;
    }
    
    setFilterStatus(roomStatus){
          this.props.dispatch(filterRoom(roomStatus));
    }

    render() {

   

    return (
        <View style = {styles.container}>
            <StatusBar hidden={true}/>
            <View>
                <Header
                    backgroundColor = "#273779"
                    leftComponent={ 
                        <Image
                            source = {require('../img/logo.png')}
                            style={styles.logo}
                        />}
                    centerComponent={{ text: 'MRBSHACK', style: { color: 'white',fontSize:32, fontWeight:'bold', left:-7 } }} 
                    rightComponent={
                        <Icon
                            onPress ={()=>{this.props.navigation.navigate('DrawerOpen') }}
                            name = "menu"
                            color = "white"
                            size = {40}
                            underlayColor = "#273779"
                        />
                    }
                />
            </View>
        
            <View style ={{flex:10, marginTop:65}}>
            <Text style = {styles.titleText}>{this.state.fetchStatus}</Text>
            <FlatList
                    contentContainerStyle={styles.flatlist}
                    data = {this.getRoomList()}
                    renderItem = {({item})=> <Roomdislay roomname={item}/>}
                    keyExtractor = {item => item.id}
                    refreshing={this.state.refreshing}
                    onRefresh={this._onRefresh.bind(this)}
            />
            </View>
            <View style = {{alignItems:'center'}}>
                <Text style = {{color:'darkgray'}}>Copyright@DEKLAB 2017</Text>
            </View>                
        </View>   
        

    );
  }
}




function mapStateToProps(state){
    return {
        myRooms: state.dekvnRooms,
        myFilter: state.filterStatus,
        };
}

export default connect(mapStateToProps)(Home);

const styles = StyleSheet.create({
  container:{
    flex: 1,
    //justifyContent: 'center',
    //alignItems: 'center',
    backgroundColor: 'white',
    flexDirection: 'column'
  },
  btnContainer:{
      backgroundColor:'palevioletred',
      flex:1,
      flexDirection:'row',
      alignItems:'center',
      justifyContent:'space-around',
      alignSelf: 'stretch',

  },
  appname:{
      fontSize: 40,
      color: 'white',  
  },
  flatlist: {
    justifyContent: 'center',
    flexDirection: 'row',
    flexWrap: 'wrap',
  },
  logo:{
    width: 100,
    height: 50,
    left:-10,
    top:5,
  },
  flag:{
    width: 20,
    height: 20,
    marginBottom:7,
    //bottom:2,  
  },
  titleText:{
    fontSize:25,
    color: '#273779',
    marginLeft: 10,
    marginTop:5,
    marginBottom:5,
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
  },
  buttonfiltertime:{
      backgroundColor:'blue',
      justifyContent: 'center',
      alignItems: 'center',
      width:90,
      height:40,
  },
  textfiltertime:{
      color:'white',
      fontSize:15,
      fontWeight:'bold',
  }
});
