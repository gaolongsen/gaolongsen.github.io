---
layout: post
title: UR5e Driver Problem in Ubuntu 20.04 with ROS Noetic
date: 2025-02-27 09:00:00-0400
description: This is a kind of weird C++ problem for the UR5e's driver installation in Ubuntu 20.04 ROS Noetic
categories: sample-posts
related_posts: false
giscus_comments: false
---

# **Compiler error with yaml-cpp - undefined reference to `YAML::detail::node_data::convert_to_map**

<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/18/ISO_C%2B%2B_Logo.svg/1200px-ISO_C%2B%2B_Logo.svg.png" style="zoom:10%;" />      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/29/Universal_robots_logo.svg/220px-Universal_robots_logo.svg.png" style="zoom:50%;" /> <img src="https://a.storyblok.com/f/169662/5873x4405/baf9b5dcd3/ur3e-4x3.png" style="zoom:3%;" />



Recently when I tried to reinstall [Ubuntu 20.04](https://releases.ubuntu.com/focal/) and [ROS Noetic](https://wiki.ros.org/noetic) again in two PCs in our lab, I met the problem like that which never happened before. That problem trouble me for a short period like below:

```sh
/usr/bin/ld: CMakeFiles/calibration_correction.dir/src/calibration.cpp.o: in function YAML::detail::node& YAML::detail::node_data::get<char [2]>(char const (&) [2], std::shared_ptr<YAML::detail::memory_holder>)':
calibration.cpp:(.text._ZN4YAML6detail9node_data3getIA2_cEERNS0_4nodeERKT_St10shared_ptrINS0_13memory_holderEE[_ZN4YAML6detail9node_data3getIA2_cEERNS0_4nodeERKT_St10shared_ptrINS0_13memory_holderEE]+0xd3): undefined reference to YAML::detail::node_data::convert_to_map(std::shared_ptr<YAML::detail::memory_holder> const&)'
/usr/bin/ld: CMakeFiles/calibration_correction.dir/src/calibration.cpp.o: in function YAML::detail::node& YAML::detail::node_data::get<char [5]>(char const (&) [5], std::shared_ptr<YAML::detail::memory_holder>)':
calibration.cpp:(.text._ZN4YAML6detail9node_data3getIA5_cEERNS0_4nodeERKT_St10shared_ptrINS0_13memory_holderEE[_ZN4YAML6detail9node_data3getIA5_cEERNS0_4nodeERKT_St10shared_ptrINS0_13memory_holderEE]+0xd3): undefined reference to YAML::detail::node_data::convert_to_map(std::shared_ptr<YAML::detail::memory_holder> const&)'
/usr/bin/ld: CMakeFiles/calibration_correction.dir/src/calibration.cpp.o: in function YAML::detail::node& YAML::detail::node_data::get<char [6]>(char const (&) [6], std::shared_ptr<YAML::detail::memory_holder>)':
calibration.cpp:(.text._ZN4YAML6detail9node_data3getIA6_cEERNS0_4nodeERKT_St10shared_ptrINS0_13memory_holderEE[_ZN4YAML6detail9node_data3getIA6_cEERNS0_4nodeERKT_St10shared_ptrINS0_13memory_holderEE]+0xd3): undefined reference to YAML::detail::node_data::convert_to_map(std::shared_ptr<YAML::detail::memory_holder> const&)'
/usr/bin/ld: CMakeFiles/calibration_correction.dir/src/calibration.cpp.o: in function YAML::detail::node& YAML::detail::node_data::get<char [4]>(char const (&) [4], std::shared_ptr<YAML::detail::memory_holder>)':
calibration.cpp:(.text._ZN4YAML6detail9node_data3getIA4_cEERNS0_4nodeERKT_St10shared_ptrINS0_13memory_holderEE[_ZN4YAML6detail9node_data3getIA4_cEERNS0_4nodeERKT_St10shared_ptrINS0_13memory_holderEE]+0xd3): undefined reference to YAML::detail::node_data::convert_to_map(std::shared_ptr<YAML::detail::memory_holder> const&)'
/usr/bin/ld: CMakeFiles/calibration_correction.dir/src/calibration.cpp.o: in function YAML::detail::node& YAML::detail::node_data::get<char [11]>(char const (&) [11], std::shared_ptr<YAML::detail::memory_holder>)':
calibration.cpp:(.text._ZN4YAML6detail9node_data3getIA11_cEERNS0_4nodeERKT_St10shared_ptrINS0_13memory_holderEE[_ZN4YAML6detail9node_data3getIA11_cEERNS0_4nodeERKT_St10shared_ptrINS0_13memory_holderEE]+0xd3): undefined reference to YAML::detail::node_data::convert_to_map(std::shared_ptr<YAML::detail::memory_holder> const&)'
/usr/bin/ld: CMakeFiles/calibration_correction.dir/src/calibration.cpp.o:calibration.cpp:(.text._ZN4YAML6detail9node_data3getINSt7__cxx1112basic_stringIcSt11char_traitsIcESaIcEEEEERNS0_4nodeERKT_St10shared_ptrINS0_13memory_holderEE[_ZN4YAML6detail9node_data3getINSt7__cxx1112basic_stringIcSt11char_traitsIcESaIcEEEEERNS0_4nodeERKT_St10shared_ptrINS0_13memory_holderEE]+0xd3): more undefined references to YAML::detail::node_data::convert_to_map(std::shared_ptr<YAML::detail::memory_holder> const&)' follow
/usr/bin/ld: CMakeFiles/calibration_correction.dir/src/calibration_correction.cpp.o: in function boost::filesystem::path::parent_path() const':
calibration_correction.cpp:(.text._ZNK5boost10filesystem4path11parent_pathEv[_ZNK5boost10filesystem4path11parent_pathEv]+0x2c): undefined reference to boost::filesystem::detail::path_algorithms::find_parent_path_size(boost::filesystem::path const&)'
/usr/bin/ld: CMakeFiles/calibration_correction.dir/src/calibration_correction.cpp.o: in function boost::filesystem::absolute(boost::filesystem::path const&, boost::filesystem::path const&)':
calibration_correction.cpp:(.text._ZN5boost10filesystem8absoluteERKNS0_4pathES3_[_ZN5boost10filesystem8absoluteERKNS0_4pathES3_]+0x3c): undefined reference to boost::filesystem::detail::absolute(boost::filesystem::path const&, boost::filesystem::path const&, boost::system::error_code*)'
collect2: error: ld returned 1 exit status
make[2]: *** [Universal_Robots_ROS_Driver/ur_calibration/CMakeFiles/calibration_correction.dir/build.make:167: /home/wam/catkin_ur/devel/lib/ur_calibration/calibration_correction] Error 1
make[1]: *** [CMakeFiles/Makefile2:9318: Universal_Robots_ROS_Driver/ur_calibration/CMakeFiles/calibration_correction.dir/all] Error 2
make: *** [Makefile:141: all] Error 2
Invoking
```

While, it's kind of C++ lib problem and I found the best solution for me to deal with the problem:



1. First, uninstall the yaml lib from your PC:

   ```sh
   sudo rm /usr/local/lib/libyaml-cpp*
   sudo rm /lib/x86_64-linux-gnu/libyaml-cpp*
   ```

   

2. Download the newest version of **libyaml-cpp** :

   ```sh
   git clone https://github.com/jbeder/yaml-cpp.git
   ```

3.  Then go the the folder you downloaded just now: 

   ```sh
   cd ~/yaml-cpp
   ```

   ```sh
   mkdir build
   ```

   ```sh
   cd build
   ```

   ```
   cmake ..
   ```

   ```sh
   make
   ```

   ```sh
   make install
   ```

4. Then close your terminal and go to your `catkin_ur` folder and then run:

   ```sh
   catkin_make clean
   ```

   ```sh
   rm -rf build devel
   ```

   ```sh
   catkin_make
   ```

After that you will see the that even though there are some warnings shown in the terminal, but you can compile the library successfully with 0 error! :smiley:
