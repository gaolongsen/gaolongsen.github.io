---

title: "Three-Arm System Build up for Hardware Notebook"
date: 2024-10-10T07:00:00-04:00
categories:
  - blog
tags:
  - MuJoCo
  - Simulation
---

# **Three-Arm System Build up for Hardware Notebook**

![](https://github.com/gaolongsen/picx-images-hosting/raw/master/three_arm_video_new.5q7qt6u2yy.webp)



This blog will record some cool stuff that I recently worked on, on how to configure the three robot arm in our lab (UR5e x 1, UR10e x 1 and WAM x 1.) **Note that this instruction has lots of changes compared with the instruction in my** 

[previous]: https://longsengao.com/blog/MuJoCo/	"link"

. Don't use that one for this project!

*-Last update: 2026.4.17*

**Step 1: Install anaconda**

[Anaconda3-2024.06-1-Linux-x86_64.sh](https://repo.anaconda.com/archive/Anaconda3-2024.06-1-Linux-x86_64.sh)  *(you can install any version later than 2021 based on my tests.)*

```shell
sudo chmod +x Anaconda3-2024.06-1-Linux-x86_64.sh
```

```shell
./Anaconda3-2024.06-1-Linux-x86_64.sh
```

**Step 2 : install git**

```shell
sudo apt install git
```

**Step 3 : install the MuJoCo library**

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



**Step 4 Install mujoco-py:**

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

**Step 5** **reboot your machine**

```sh
sudo reboot
```

**Step 6** **run these commands**

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

**Step 7** **Install ROS2 Humble**

Please follow the official website here: https://docs.ros.org/en/humble/Installation/Ubuntu-Install-Debs.html

