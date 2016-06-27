# .bashrc

# Source global definitions
if [ -f /etc/bashrc ]; then
        . /etc/bashrc
fi

# User specific aliases and functions

if [ -f ~/.bash_git ]; then
   . ~/.bash_git
fi

alias vi=vim