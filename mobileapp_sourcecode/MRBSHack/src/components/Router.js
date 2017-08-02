import React, {Component} from 'react';
import {Text,View } from 'react-native';
import { StackNavigator, TabNavigator, DrawerNavigator } from 'react-navigation';

import Home from './Home';
import Menu from './Menu';




export const HomeStack = StackNavigator({
    Manhinh_Home: {
        screen: Home,
    },
  },
   
  {headerMode: 'none',
  }
)

export const SlideMenu = DrawerNavigator({
   Tabs:{
        screen: HomeStack,
   },
},
   {
        drawerWidth: 200,
        drawerPosition: 'right',
        contentComponent: props => <Menu {...props} />
   }
);
