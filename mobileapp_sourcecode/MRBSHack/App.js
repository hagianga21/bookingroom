import React,{Component} from 'react';
import { StyleSheet, Text, View } from 'react-native';
import {createStore} from 'redux';
import {Provider} from 'react-redux';

import {SlideMenu} from './src/components/Router';

import {FILTER,FETCH} from './src/components/Action';



export default class App extends Component {
  render() {
    return (
        <Provider store = {store}>
              <SlideMenu/>
        </Provider>
    );
  }
}

//defaultState
const defaultState={
    dekvnRooms: [],
    filterStatus: 'AVAILABLE_ROOM',
    //isAdding: false
};




//reducer -> tien doan action
const reducer = (state = defaultState,action) => {
      switch (action.type) {
        case FILTER:
            return {...state, filterStatus: action.roomStatus};
        case FETCH:
            return {...state, dekvnRooms: action.dataFromJSON};
        default:
            return defaultState;
      }

};


//Tao ra Store
const store = createStore(reducer);
