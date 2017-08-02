import React, { Component } from 'react';
import { StatusBar, StyleSheet, Text, View, ListView,Image,TouchableHighlight,TouchableOpacity } from 'react-native';

export default class Menu extends Component {
    constructor(props){
        super(props);
        this.state={
            country:0
        }
    }
    _onpresschoosevietnam(){
        this.setState({
            country:1
        })
        alert("you've already chosen Vietnam")
    }
    _onpresschooseaustralia(){
        this.setState({
            country:2
        })
        alert("coming soon")
    }
    _onpresschooseamerica(){
        this.setState({
            country:3
        })
        alert("coming soon")
    }
    _onpresschooseitaly(){
        this.setState({
            country:4
        })
        alert("coming soon")
    }
    _onpresschoosesweden(){
        this.setState({
            country:5
        })
        alert("coming soon")
    }
    render(){
        return(
            <View style={styles.container}>
                <StatusBar hidden={true}/>
                <Text style={styles.texttitlecountry} >COUNTRY</Text>
                <TouchableOpacity
                    onPress={this._onpresschoosevietnam.bind(this)} 
                >
                    <View style={styles.buttonchoosecountry}>
                        <Image
                            source = {require('../img/vietnam.png')}
                            style={styles.imagecountry}
                        />
                        <Text style = {styles.textcountry}>Vietnam</Text>
                    </View>
                </TouchableOpacity>
                <TouchableOpacity
                    onPress={this._onpresschooseaustralia.bind(this)} 
                >
                    <View style={styles.buttonchoosecountry}>
                        <Image
                            source = {require('../img/australia.png')}
                            style={styles.imagecountry}
                        />
                        <Text style = {styles.textcountry}>Australia</Text>
                    </View>
                </TouchableOpacity>
                <TouchableOpacity
                    onPress={this._onpresschooseamerica.bind(this)} 
                >
                    <View style={styles.buttonchoosecountry}>
                        <Image
                            source = {require('../img/america.png')}
                            style={styles.imagecountry}
                        />
                        <Text style = {styles.textcountry}>America</Text>
                    </View>
                </TouchableOpacity>
                <TouchableOpacity
                    onPress={this._onpresschooseitaly.bind(this)} 
                >
                    <View style={styles.buttonchoosecountry}>
                        <Image
                            source = {require('../img/italy.png')}
                            style={styles.imagecountry}
                        />
                        <Text style = {styles.textcountry}>Italy</Text>
                    </View>
                </TouchableOpacity>
                <TouchableOpacity
                    onPress={this._onpresschoosesweden.bind(this)} 
                >
                    <View style={styles.buttonchoosecountry}>
                        <Image
                            source = {require('../img/sweden.png')}
                            style={styles.imagecountry}
                        />
                        <Text style = {styles.textcountry}>Sweden</Text>
                    </View>
                </TouchableOpacity>
            </View>  
        );
    }
}

const styles = StyleSheet.create({
  container:{
    flex: 1,
    justifyContent: 'flex-start',
    alignItems: 'flex-start',
    backgroundColor: 'white',
    flexDirection: 'column'
  },
  texttitlecountry:{
    fontSize:38,
    padding:5,
    fontWeight:'bold',
    color: 'crimson'
  },
  buttonchoosecountry:{
    flexDirection: 'row',
    marginTop: 5,
  },
  textcountry:{
    fontSize:20,
    fontWeight:'bold',
    color: 'black',
    marginLeft: 15,
  },
  imagecountry:{
    width: 40, 
    height: 20,
    marginLeft: 15,
  }
})