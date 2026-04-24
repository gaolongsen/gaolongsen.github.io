---

title: "Three-Arm System Build up for Hardware Notebook"
date: 2024-10-10T07:00:00-04:00
categories:
  - blog
tags:
  - Hardware
  - ROS2
  - MuJoCo
  - Simulation
---

# **Three-Arm System Build up for Hardware Notebook**

![](https://github.com/gaolongsen/picx-images-hosting/raw/master/three_arm_video_new.5q7qt6u2yy.webp)



This blog will record some cool stuff that I recently worked on, on how to configure the three robot arm in our lab (UR5e x 1, UR10e x 1 and WAM x 1.) **Note that this instruction has lots of changes compared with the instruction in my** 

[previous]: https://longsengao.com/blog/MuJoCo/	"link"

. Don't use that one for this project!

*-Last update: 2026.4.17*

## Section 1: Environment Preparation

### **Step 1: Install anaconda**

[Anaconda3-2024.06-1-Linux-x86_64.sh](https://repo.anaconda.com/archive/Anaconda3-2024.06-1-Linux-x86_64.sh)  *(you can install any version later than 2021 based on my tests.)*

```shell
sudo chmod +x Anaconda3-2024.06-1-Linux-x86_64.sh
```

```shell
./Anaconda3-2024.06-1-Linux-x86_64.sh
```

### **Step 2 : install git**

```shell
sudo apt install git
```

### **Step 3 : install the MuJoCo library**

1. ~~Download the MuJoCo library from~~

   ~~https://mujoco.org/download/mujoco210-linux-x86_64.tar.gz~~

(Update: now you don't need to do this, just follow the operations below.)

2. create a hidden folder :

```shell
sudo mkdir /home/agman/.mujoco
```

```shell
sudo chmod a+rwx /home/agman/.mujoco
```

(Note: if the folder you created without any permission, use “**sudo chmod a+rwx   /path/to/file**” to give the folder permission)

```shell
cd /home/agman/.mujoco
```

```shell
git clone https://github.com/gaolongsen/mujoco210.git
```

3. include these lines in `.bashrc` file(terminal command: **gedit ~/.bashrc**):

   ```shell
   gedit ~/.bashrc
   ```
   
4. Then add the following four lines on the bottom of you `.bashrc` file:

```shell
export LD_LIBRARY_PATH=/home/agman/.mujoco/mujoco210/bin
export LD_LIBRARY_PATH=$LD_LIBRARY_PATH:/usr/lib/nvidia
export PATH="$LD_LIBRARY_PATH:$PATH"
export LD_PRELOAD=/usr/lib/x86_64-linux-gnu/libGLEW.so
```

(:point_up_2:Note that don't forget to replace the `wam` with your local PC name.) 

Note that for ubuntu 22.04, you should also install the following package:

```shell
sudo apt install libglew-dev
```

5. ```shell
   source ~/.bashrc
   ```

6. Test that the library is installed by going into:

```shell
cd ~/.mujoco/mujoco210/bin
```

```shell
./simulate ../model/humanoid.xml
```

If you are successful, you will see like this:

<img src="https://github.com/gaolongsen/picx-images-hosting/raw/master/human_mujoco.wivxg0alf.webp" style="zoom:80%;" />



### **Step 4 Install mujoco-py:**

```shell
conda create --name mujoco_py python=3.10
```

```shell
conda activate mujoco_py
```

```shell
sudo apt update
```

```shell
sudo apt-get install patchelf
```

```shell
sudo apt-get install python3-dev build-essential libssl-dev libffi-dev libxml2-dev 
```
Note that below command is different than the instructions for Ubuntu 20.04 with Python 3.8, be care!
```
sudo apt-get install libxslt1-dev zlib1g-dev libglew2.2 libglew-dev python3-pip
```

```shell
git clone https://github.com/openai/mujoco-py
```

```shell
cd mujoco-py
```

```shell
pip install -r requirements.txt
```

```shell
pip install -r requirements.dev.txt
```

```shell
pip3 install -e . --no-cache
```

### **Step 5** **reboot your machine**

```sh
sudo reboot
```

### **Step 6** **run these commands**

```shell
conda activate mujoco_py
```

```shell
sudo apt install libosmesa6-dev libgl1-mesa-glx libglfw3
```

```shell
sudo ln -s /usr/lib/x86_64-linux-gnu/libGL.so.1 
```

```shell
sudo ln -s /usr/lib/x86_64-linux-gnu/libGL.so
```

```shell
pip3 install -U 'mujoco-py<2.2,>=2.1'
```

```shell
pip install "cython<3"
```

(**PS:** above command you don't have to do if you run the following example test without any error happened. But based on our test, you probably need to downgrade the *cython* to avoid any potential problem.)

```shell
cd examples
```

```shell
python3 setting_state.py
```

If you successfully setup your environment, you will see the demo run like this:

<img src="https://github.com/gaolongsen/picx-images-hosting/raw/master/state_mujoco_test.2vf2nscuhl.webp" style="zoom:15%;" />

**If you’re getting a Cython error, try:**

```shell
pip install "cython<3"
```

Note: if you use ***[Pycharm](https://www.jetbrains.com/pycharm/)*** as your compiler, don't forget to add this line on `Run` -> `Edit Configuration` -> `Environment variables`:

```
LD_LIBRARY_PATH=$LD_LIBRARY_PATH:/home/wam/.mujoco/mujoco210/bin:/usr/lib/nvidia;LD_PRELOAD=/usr/lib/x86_64-linux-gnu/libGLEW.so
```

(:point_up_2:Note that don't forget to replace the `wam` with your local PC name.) 

### **Step 7** **Install ROS2 Humble**

Please follow the official website here: https://docs.ros.org/en/humble/Installation/Ubuntu-Install-Debs.html

## Section 2: Prepare UR robotics

### **Step 1** **Set up UR Driver for ** <span style="color:blue">UR10e</span>

```bash
sudo apt-get install ros-humble-ur
```

```bash
ros2 launch ur_calibration calibration_correction.launch.py \
    robot_ip:=192.168.1.5 \
    target_filename:="${HOME}/my_ur10e_calibration.yaml"
```
Note that when you connect with UR10e, be careful!!! In Ubuntu 22.04, if you use PyCharm, PyCharm will occupy port 50001! Here are the workflow between your PC and the robot arm.

```
Your PC (192.168.1.22)        UR10e Robot (192.168.1.5)
  │                                    │
  │  ROS driver startup                │
  │  → Listen on port 50001 ───────────┤
  │                                    │
  │            Pannel Button ▶         │
  │            Run External Control    │
  │                                      │
  │  ← ─ Robot reverse connection 50001 ─┤
  │  （That's why we call "reverse"）     │
```

So, 50001 is a port on your PC, not on the robot. The notion of ‘changing 50001 on the robot controller’ is not really correct.

In the External Control URCap, the only thing you can set is which port on your PC the robot should connect to, and that port must match the one the UR driver is listening on.

The UR driver uses four ports in total:

| Parameter             | Default Value | Function                                                     |
| --------------------- | ------------- | ------------------------------------------------------------ |
| `reverse_port`        | 50001         | Port used for the robot’s reverse connection back to the PC; this is the one most likely to conflict with PyCharm. |
| `script_sender_port`  | 50002         | Port used to send URScript to the robot.                     |
| `trajectory_port`     | 50003         | Port used to send trajectory data.                           |
| `script_command_port` | 50004         | Port used to send control commands.                          |

To avoid that, we need to reset up the port for UR and here is my example below:

```bash
ros2 launch ur_robot_driver ur_control.launch.py \
    ur_type:=ur10e \
    robot_ip:=192.168.1.5 \
    kinematics_params_file:="${HOME}/my_ur10e_calibration.yaml" \
    reverse_port:=50010 \
    script_sender_port:=50020 \
    trajectory_port:=50030 \
    script_command_port:=50040 \
    launch_rviz:=true
```

Then on your UR panel, you should set up as follows:

![](https://github.com/gaolongsen/picx-images-hosting/raw/master/UR10e_setup_pannel.58hyv8t2xz.webp)

Note that here the "Custom Port" should not be the same as the **script_sender_port** you set in your PC.

### **Step 2** **Set up UR Driver for **<span style="color:red">UR5e</span>

This is **the most challenging part** in this project! We know that any UR robotics use the same lib in just one PC whatever you use ROS1 or ROS2. In this context, we need to use the orignal tool from ROS2: `namespace` and `tf_prefix`

- **`namespace`**： Add a prefix to each topic/service/node of every robot, e.g., `/ur10e/joint_states`、`/ur5e/joint_states`
- **`tf_prefix`**：Add prefixes to all URDF links for each robot，e.g., `ur10e_base_link`、`ur5e_base_link`

Because UR driver support these two parameters, so we don't need to change the original lib from UR.

**Port Planning**

Assign a separate port range to each machine, spaced far enough apart to avoid future conflicts with PyCharm:

| Parameter             | UR10e | UR5e  |
| --------------------- | ----- | ----- |
| `reverse_port`        | 50110 | 50210 |
| `script_sender_port`  | 50120 | 50220 |
| `trajectory_port`     | 50130 | 50230 |
| `script_command_port` | 50140 | 50240 |

Then we need  to create a workspace structure in local for two robot arm as

```
~/workspace/ur_dual_ws/
└── src/
    └── ur_dual_bringup/
        ├── package.xml
        ├── CMakeLists.txt
        ├── launch/
        │   ├── dual_ur.launch.py        # 主入口
        │   ├── single_ur.launch.py      # 单台 UR 的可复用 launch
        │   └── dual_ur_moveit.launch.py # 可选：MoveIt 部分
        └── config/
            └── dual_ur_controllers.yaml
```

For `dual_ur.launch.py` file, we should write:

```python
from launch import LaunchDescription
from launch.actions import IncludeLaunchDescription, GroupAction
from launch.launch_description_sources import PythonLaunchDescriptionSource
from launch_ros.actions import PushRosNamespace
from ament_index_python.packages import get_package_share_directory
import os


def generate_launch_description():
    ur_driver_launch = os.path.join(
        get_package_share_directory('ur_robot_driver'),
        'launch',
        'ur_control.launch.py'
    )

    # ---- UR10e ----
    ur10e_group = GroupAction([
        PushRosNamespace('ur10e'),
        IncludeLaunchDescription(
            PythonLaunchDescriptionSource(ur_driver_launch),
            launch_arguments={
                'ur_type':              'ur10e',
                'robot_ip':             '192.168.1.5',
                'kinematics_params_file': os.path.expanduser('~/my_ur10e_calibration.yaml'),
                'tf_prefix':            'ur10e_',
                'reverse_port':         '50110',
                'script_sender_port':   '50120',
                'trajectory_port':      '50130',
                'script_command_port':  '50140',
                'launch_rviz':          'false',
                'use_tool_communication': 'false',
            }.items(),
        ),
    ])

    # ---- UR5e ----
    ur5e_group = GroupAction([
        PushRosNamespace('ur5e'),
        IncludeLaunchDescription(
            PythonLaunchDescriptionSource(ur_driver_launch),
            launch_arguments={
                'ur_type':              'ur5e',
                'robot_ip':             '192.168.1.6',
                'kinematics_params_file': os.path.expanduser('~/my_ur5e_calibration.yaml'),
                'tf_prefix':            'ur5e_',
                'reverse_port':         '50210',
                'script_sender_port':   '50220',
                'trajectory_port':      '50230',
                'script_command_port':  '50240',
                'launch_rviz':          'false',
                'use_tool_communication': 'false',
            }.items(),
        ),
    ])

    return LaunchDescription([ur10e_group, ur5e_group])
```

In `package.xml` file, we should write as

```xml
<?xml version="1.0"?>
<package format="3">
  <name>ur_dual_bringup</name>
  <version>0.0.1</version>
  <description>Dual UR10e + UR5e bringup</description>
  <maintainer email="you@example.com">you</maintainer>
  <license>Apache-2.0</license>

  <exec_depend>ur_robot_driver</exec_depend>
  <exec_depend>ur_description</exec_depend>
  <exec_depend>ur_moveit_config</exec_depend>

  <export>
    <build_type>ament_cmake</build_type>
  </export>
</package>
```

In `CMakeLists.txt` file, we should write as

```t
cmake_minimum_required(VERSION 3.8)
project(ur_dual_bringup)
find_package(ament_cmake REQUIRED)

install(DIRECTORY launch config
  DESTINATION share/${PROJECT_NAME}
)

ament_package()
```

